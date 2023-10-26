<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProductContronller extends Controller
{
    public int $itemPerPage = 8;

    public function index(): View
    {

        return view('client.products.list');
    }

    public function detail(string $id): View
    {

        $product = Product::getProductById($id);

        $productRating = round(ProductReview::where('product_id', $product->id)->avg('rating'),1);

        $feedbacks = ProductReview::where('product_id', $product->id)->get();

        $relatedProducts = Product::all()->take(4);

        $productReviews = ProductReview::where('product_id', $product->id)->get();

        $checkBought = false;
        if (Auth::user()) {
            $productIds = [];

            foreach (Auth::user()->orders as $order) {
                foreach ($order->orderProducts as $orderProduct) {
                    $productIds[] = $orderProduct->product_id;
                }
            }

            if(in_array($id, $productIds)) {
                $checkBought = true;
            }
        }


        return view('client.products.detail', compact('product', 'relatedProducts','productReviews','checkBought', 'productRating', 'feedbacks'));
    }

    public function addToCart(int $product_id, Request $request): RedirectResponse
    {
        $data = $request->validate([
            'qty' => ['nullable', 'int', 'min:1']
        ]);

        if (! Auth::check()) {
            toast('Đăng nhập trước khi sử dụng dịch vụ', 'warning');
            return redirect('login');
        }

        if (Cart::where('user_id', Auth::user()->id)->where('product_id', $product_id)->exists()) {
            toast('Sản phẩm đã có trong giỏ hàng.', 'warning');
            return redirect()->back();
        }

        $product = Product::getProductById($product_id);

        if ($data['qty']) {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product_id,
                'quantity' => $data['qty'],
            ]);

            toast('Thêm sản phẩm' . $product->name . 'vào giỏ hàng thành công', 'success');

            return redirect()->back();
        }

        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $product_id,
            'quantity' => 1,
        ]);

        toast('Thêm sản phẩm' . $product->name . 'vào giỏ hàng thành công', 'success');

        return redirect()->back();
    }

    public function showProductsByCategory(string $id)
    {
        $category = Category::findOrFail($id);
        $products = $category->products;

        return view('client.products.list', compact('category', 'products'));
    }

}
