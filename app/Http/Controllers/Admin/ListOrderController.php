<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ListOrderController extends Controller
{
    public int $itemPerPage = 10;

    public function index(): View
    {
        $orders = Order::query()->orderByDesc('created_at')->paginate($this->itemPerPage);

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
            'staff' => Auth::user()->id,
        ]);

        toast('Cập nhật trạng thái thành công', 'success');

        return redirect('order');
    }
}
