<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\District;
use App\Models\Product;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View|RedirectResponse
    {

        if (! Auth::check()) {
            toast('Đăng nhập trước khi sử dụng dịch vụ', 'warning');
            return redirect('login');
        }
        $carts = Cart::where('user_id', Auth::user()->id)->get();

        return view('client.carts.index', compact('carts'));
    }


    public function update(Request $request): JsonResponse
    {
        $data = $request->validate([
            'id' => ['required', 'integer'],
            'type' => ['required', 'in:inc,dec'],
        ]);

        $product = Cart::find($data['id']);

        if (! $product) {
            return response()->json([
                'message' => 'Không tìm thấy sản phẩm',
            ]);
        }

        if ($data['type'] == 'inc') {
            $product->update([
                'quantity' => $product->quantity + 1,
            ]);

            return response()->json([
                'message' => 'success',
                'data' => $product,
            ]);
        }

        if ($data['type'] == 'dec') {
            if ($product->quantity >= 2) {
                $product->update([
                    'quantity' => $product->quantity - 1,
                ]);

                return response()->json([
                    'message' => 'success',
                    'data' => $product,
                ]);
            }
        }

        $product->delete();

        return response()->json([
            'message' => 'success',
            'data' => 'Xóa thành công',
        ]);
    }


    public function destroy(string $id): RedirectResponse
    {

        $carts = Cart::getCartByUserId($id);

        $carts->delete();

        toast('Xóa thành công sản phẩm', 'success');

        return redirect('cart-list');
    }

    public function checkout(): View
    {

        $carts = Cart::where('user_id', Auth::user()->id)->get();
        $provinces = Province::all();
        $addresses = Address::where('user_id', Auth::user()->id)->get();

        foreach ($carts as $item){
            if(! Product::where('id', $item->product_id)->where('stock', '>=', $item->quantity)->exists()){
                $removeItem = Cart::where('user_id', Auth::user()->id)->where('product_id', $item->product_id)->first();
                $removeItem -> delete();
            }
        }

        $cartItems = Cart::where('user_id', Auth::user()->id)->get();

        return view('client.carts.checkout', compact('cartItems','provinces','addresses'));
    }
}
