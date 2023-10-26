<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductReviewController extends Controller
{
    public function create(Request $request, string $id): RedirectResponse
    {

        $data = $request->validate([
            'comment' => 'required',
            'rating' => 'required'
        ]);
        if (! Auth::check()) {
            toast('Đăng nhập trước khi sử dụng dịch vụ', 'warning');
            return redirect('login');
        }

        $product = Product::getProductById($id);

            ProductReview::create([
                'user_id' => Auth::user()->id,
                'product_id' => $product->id,
                'comment' => $data['comment'],
                'rating' => $data['rating'],
            ]);

            toast('Đánh giá thành công', 'success');

            return redirect()->back();
   }

}
