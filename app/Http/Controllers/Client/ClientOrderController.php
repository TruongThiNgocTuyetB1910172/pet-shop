<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ClientOrderController extends Controller
{

    public function index(): View
    {
        return view('client.orders.index');
    }

    public function history(): View
    {
        $orders = Order::where('user_id', Auth::user()->id)->get();

        return view('client.orders.purchase-history', compact('orders'));
    }

    public function detail(string $id): View
    {
        $order = Order::getOrderById($id);

        $orderProduct = OrderProduct::where('order_id', $order->id)->get();

        return view('client.orders.detail', compact('order','orderProduct'));
    }
}
