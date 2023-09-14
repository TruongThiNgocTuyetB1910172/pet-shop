<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProductContronller extends Controller
{
    public int $itemPerPage = 6;

    public function index(): View
    {
        $categories = Category::all();
        $products = Product::query()
            ->where('stock', '>', 0)
            ->orderByDesc('created_at')
            ->paginate($this->itemPerPage);
        return view('client.products.list', compact('products', 'categories'));
    }

    public function detail(string $id): View
    {
        $product = Product::getProductById($id);

        $relatedProducts = Product::all()->take(4);

        return view('client.products.detail', compact('product', 'relatedProducts'));
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


}
