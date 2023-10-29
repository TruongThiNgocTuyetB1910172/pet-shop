<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class ClientOrderController extends Controller
{
    public function index(): View
    {
        return view('client.orders.index');
    }

    public function thankYou()
    {
        $response = request()->query->all();
        if (! $response){
            return view('client.orders.thank-you');
        }

        if ($response['vnp_TransactionStatus'] != '00') {
            return redirect()->back();
        }

        Cart::where('user_id', Auth::user()->id)->delete();
        Order::where('tracking_number', $response['vnp_TxnRef'])->update([
            'payment_status' => 'thanh cong',
        ]);

        return view('client.orders.thank-you');
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

        return view('client.orders.detail', compact('order', 'orderProduct'));
    }

    public function cancel(string $id): RedirectResponse
    {
        $order = Order::getOrderById($id);

        $orderProduct = OrderProduct::where('order_id', $order->id)->get();

        $order->update([
            'status' => 'cancel',
        ]);
        foreach ($orderProduct as $product) {
            OrderProduct::updated([
                'quantity' => $product->quantity,
            ]);
            $findProduct = Product::getProductById($product->product->id);

            $findProduct->update([
                'stock' => $findProduct->stock + $product->quantity,
            ]);
        }

        toast('Hủy đơn hàng thành công', 'success');

        return redirect()->route('purchase.history');

    }

    public function review(Request $request, string $id): RedirectResponse
    {
        $data = $request->validate([
            'reviews' => 'nullable',
        ]);
        $order = Order::getOrderById($id);

        $order->update([
            'reviews' =>$data['reviews'],
        ]);

        toast('Cập nhật thành công ', 'success');

        return redirect('purchase-history');
    }

}
