<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Receipt;
use App\Models\ReceiptDetail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ReceiptController extends Controller
{
    public int $itemPerPage = 10;

    public function index(): View
    {
        $receipts = Receipt::query()->orderByDesc('created_at')->paginate($this->itemPerPage);

        return view('admin.receipts.index', compact('receipts'));
    }

    public function create(): View
    {
        $products = Product::all();

        $receipts = session()->get('options');

        return view('admin.receipts.create', compact('products', 'receipts'));
    }

    public function addProductItemToReceipt(Request $request): RedirectResponse
    {
        $product_ids = $request->input('options', []);
        $data = json_encode($product_ids);

        session()->put('san_pham', $data);

        return redirect('show-receipt');
    }

    public function getReceiptProduct(): View
    {
        $data = json_decode(session()->get('san_pham'));

        if ($data) {
            $products = Product::whereIn('id', $data)->get();
            return view('admin.receipts.show', compact('products'));
        }

        $products = collect();
        return view('admin.receipts.show', compact('products'));
    }

    public function addPriceAndQuantity(Request $request): RedirectResponse
    {
        $quantity = $request->input('quantity', []);
        $price = $request->input('price', []);
        $product = json_decode(session()->get('san_pham'));

        $data = [
            'quantity' => $quantity,
            'price' => $price,
            'san_pham' => $product,
        ];

        $matchedData = [];
        foreach ($data['san_pham'] as $index => $sanPham) {
            $matchedData[] = [
                'quantity' => $data['quantity'][$index],
                'price' => $data['price'][$index],
                'san_pham' => $sanPham
            ];
        }

        $amount = 0;
        foreach ($matchedData as $product) {
            $amount += $product['quantity'] * $product['price'];
        }
        $notes  = $request->input('notes');

        $receipt = Receipt::create([
            'total' => $amount,
            'tracking_number' => 'TTNT'. Str::random(16),
            'notes' => $notes,
            'admin_id' => Auth::guard('admin')->user()->id,
        ]);

        foreach ($matchedData as $product) {
            ReceiptDetail::create([
                'receipt_id' => $receipt->id,
                'product_id' => $product['san_pham'],
                'quantity' => $product['quantity'],
                'price' => $product['price'],
            ]);
            //
            //            $findProduct = Product::getProductById($product['san_pham']);
            //            $findProduct->update([
            //                'stock' => $findProduct->stock + $product['quantity'],
            //                'original_price' => $product['price']
            //            ]);
        }
        session()->forget('san_pham');
        toast('Thêm mới thành công phiếu nhập', 'success');
        return redirect()->route('receipt.index');
    }

    public function edit(string $id): View
    {
        $receipt = Receipt::getReceiptById($id);

        $receiptDetails = ReceiptDetail::where('receipt_id', $receipt->id)->get();

        return view('admin.receipts.edit', compact('receiptDetails', 'receipt'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {

        $data = $request->validate([
            'status' => 'in:pending,accepted',
            'notes' => 'nullable',
        ]);
        $receipt = Receipt::getReceiptById($id);
        $receipt->update([
            'status' => $data['status'],
            'notes' => $data['notes'],
        ]);
        if($receipt->status == 'accepted') {
            $receiptDetails = $receipt->receiptDetails;
            foreach ($receiptDetails as $detail) {
                $findProduct = Product::getProductById($detail->product_id);
                $findProduct->update([
                    'stock' => $findProduct->stock + $detail['quantity'],
                    'original_price' => $detail['price']
                ]);
            }
        }
        toast('Cập nhật thành công', 'success');

        return redirect('receipt');
    }

    public function detail(string $id): View
    {

        $receipt  = Receipt::getReceiptById($id);

        $receiptDetails = ReceiptDetail::where('receipt_id', $receipt->id)->get();

        return view('admin.receipts.detail', compact('receipt', 'receiptDetails'));
    }

    public function delete(string $id)
    {
        $receipt = Receipt::getReceiptById($id);
        $receiptDetails = $receipt->receiptDetails;
        foreach ($receiptDetails as $detail) {
            $detail->delete();
        }
        $receipt->delete();
        toast('Xóa phiếu nhập thành công', 'success');
        return redirect('receipt');
    }


}
