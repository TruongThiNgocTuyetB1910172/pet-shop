<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $carts = Cart::all();

        return view('client.carts.index',compact('carts'));
    }

    public function update(Request $request, String $id): RedirectResponse
    {
        $data = $request->validate([
            'qty' => ['nullable', 'int', 'min:1']
        ]);
        $carts = Cart::getCartById($id);

        $carts->update([
            'quantity' => $data['qty'],
        ]);

       toast('Cap nhat so luong vào giỏ hàng thành công','success');

        return redirect('cart');
    }

    public function destroy(string $id): RedirectResponse
    {

        $carts = Cart::getCartById($id);

        $carts->delete();

        toast('Xóa thành công san pham','success');

        return redirect('cart-list');
    }


}
