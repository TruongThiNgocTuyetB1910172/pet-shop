<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\WishList;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class Wishlistcontroller extends Controller
{
    public function index(): View
    {
        $wishLists = WishList::where('user_id', Auth::user()->id)->get();
        return view('client.wishlist.index', compact('wishLists'));
    }

    public function addToWishList(string $id): RedirectResponse
    {

        $product = Product::getProductById($id);

        if (! Auth::check()) {
            toast('Đăng nhập trước khi sử dụng dịch vụ', 'warning');
            return redirect('login');
        }

        if (WishList::where('user_id', Auth::user()->id)->where('product_id', $product->id)->exists()) {
            toast('Sản phẩm đã có trong yêu thích.', 'warning');
            return redirect()->back();
        }
        WishList::create([
            'product_id' => $product->id,
            'user_id' => Auth::user()->id,
        ]);

        toast('Thêm vào yêu thích thành công', 'success');

        return redirect()->back();
    }

    public function destroy(string $id): RedirectResponse
    {
        $wishlist = WishList::getWishListById($id);

        $wishlist->delete();

        toast('Xóa sản phẩm khỏi danh sách yêu thích', 'success');

        return redirect()->back();
    }

}
