<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public int $itemPerPage = 10;

    public function index(): View
    {
        $reviews = ProductReview::query()->orderByDesc('created_at')->paginate($this->itemPerPage);

        return view('admin.reviews.index', compact('reviews'));
    }

    public function edit(string $id): View
    {

        $review = ProductReview::getProductReviewById($id);

        return view('admin.reviews.edit', compact('review'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $review = ProductReview::getProductReviewById($id);

        $data = $request->validate([
            'status' => 'in:0,1',
        ]);

        $review->update([
            'status' => $data['status'],
        ]);
        toast('Cập nhật trạng thái thành công', 'success');

        return redirect('manager-review');
    }
}
