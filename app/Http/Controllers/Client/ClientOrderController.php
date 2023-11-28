<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use App\Models\Feedback;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
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
    public function history(): View
    {
        $orders = Order::where('user_id', Auth::user()->id)->orderByDesc('created_at')->get();
        ;

        return view('client.orders.purchase-history', compact('orders'));
    }

    public function detail(string $id): View
    {

        $order = Order::getOrderById($id);

        $orderProducts = OrderProduct::where('order_id', $order->id)->get();

        $orderFeedbacks = Feedback::where('order_id', $order->id)->get();

        return view('client.orders.detail', compact('order', 'orderProducts', 'orderFeedbacks'));
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

    public function commentOnProduct(string $productId): RedirectResponse
    {
        Session::put('comment_product_id', $productId);
        Session::put('feedback_id', null);

        return redirect()->route('product-list.detail', ['id' => $productId]);
    }

}
