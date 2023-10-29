<?php

namespace App\Http\Controllers\Shipper;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ShipperOrderController extends Controller
{

    public function index(): View
    {
        $orders = Order::where('shipper_id', Auth::guard('shipper')->user()->id)->get();

        return view('shipper.orderLists.index', compact('orders'));
    }

    public function edit(string $id): View
    {
        $order = Order::getOrderById($id);

        $orderProducts = OrderProduct::where('order_id', $order->id)->get();

        return view('shipper.orderLists.edit', compact('order', 'orderProducts'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $data = $request->validate([
            'order_shipper_status' => 'in:pending,accepted,refuse,fail,success',
//            'status' => 'in:pending,accepted,inDelivery,success,cancel,refund',
        ]);

        $order = Order::getOrderById($id);

        $order->update([
            'order_shipper_status' => $data['order_shipper_status'],
        ]);

        if($order->order_shipper_status === 'accepted'){
            $order->update([
                'status' => 'inDelivery',
            ]);
        }

        if($order->order_shipper_status === 'success'){
            $order->update([
                'status' => 'success',
            ]);
        }

        toast('Cập nhật trạng thái thành công', 'success');

        return redirect('order-list');
    }
}
