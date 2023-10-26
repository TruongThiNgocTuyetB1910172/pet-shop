<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Shipper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    public int $itemPerPage = 10;

    public function index(): View
    {
        $searchTerm = request()->query('searchTerm') ?? '';

        if (is_array($searchTerm)) {
            $searchTerm = '';
        }

        $search = '%' . $searchTerm . '%';

        $orders = Order::where(function ($query) use ($search) {
            $query->where('tracking_number', 'like', $search)
                ->orWhere('shipping_address', 'like', $search);
        })
            ->with('admin')
            ->orderByDesc('created_at')
            ->paginate($this->itemPerPage);

        return view('admin.orders.index', compact('orders'));
    }

    public function edit(string $id): View
    {
        $order = Order::getOrderById($id);

        $orderProducts = OrderProduct::where('order_id', $order->id)->get();

        $shippers = Shipper::where('status', '=', '1')->get();

        return view('admin.orders.edit', compact('order', 'orderProducts', 'shippers'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $data = $request->validate([
            'status' => 'in:pending,accepted,inDelivery,success,cancel,refund',
            'shipper_id' => 'nullable'
        ]);

        $order = Order::getOrderById($id);

       if ($order->status === 'accepted'){
           $order->update([
               'status' => $data['status'],
               'admin_id' => Auth::guard('admin')->user()->id,
               'shipper_id' => $data['shipper_id'],
               'order_shipper_status' => 'pending',
           ]);
       }
       $order->update([
           'status' => $data['status'],
       ]);

        if ($order->status == 'cancel') {
            $orderProduct = OrderProduct::where('order_id', $order->id)->get();
            foreach ($orderProduct as $product) {
                OrderProduct::updated([
                    'quantity' => $product->quantity,
                ]);
                $findProduct = Product::getProductById($product->product->id);
                $findProduct->update([
                    'stock' => $findProduct->stock + $product->quantity,
                ]);
            }
        }

        toast('Cập nhật trạng thái thành công', 'success');

        return redirect('order');
    }
}
