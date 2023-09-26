<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    public int $itemPerPage = 10;

    public function index(): View
    {
        $orders = Order::orderByDesc('created_at')
            ->with('admin')
            ->paginate($this->itemPerPage);

        return view('admin.orders.index', compact('orders'));
    }

    public function edit(string $id): View
    {
        $order = Order::getOrderById($id);

        $orderProducts = OrderProduct::where('order_id', $order->id)->get();

        return view('admin.orders.edit', compact('order','orderProducts'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $data = $request->validate([
            'status' => 'in:pending,accepted,inDelivery,success,cancel,refund',
        ]);
        $order = Order::getOrderById($id);

        $order->update([
            'status' => $data['status'],
            'staff' => Auth::guard('admin')->user()->id,
        ]);

        if ($order->status == 'cancel'){
            $orderProduct = OrderProduct::where('order_id', $order->id)->get();
            foreach ($orderProduct as $product){
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
