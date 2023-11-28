<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientFeedBackController extends Controller
{
    public function store(Request $request, string $id): RedirectResponse
    {

        $data = $request->validate([
            'feedback' => 'required',
            'rating' => 'required'
        ]);

        $order = Order::getOrderById($id);
        Feedback::create([
            'user_id' => Auth::user()->id,
            'order_id' => $order->id,
            'feedback' => $data['feedback'],
            'rating' => $data['rating'],
        ]);

        toast('Thêm đánh giá thành công ', 'success');

        return redirect()->back();

    }
}
