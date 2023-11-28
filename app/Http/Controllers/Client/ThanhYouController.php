<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ThanhYouController extends Controller
{
    public function thankYou(): View
    {
        return view('client.orders.thank-you');
    }

    public function paymentCallback()
    {
        $message = 'Giao dịch thành công';
        $vnpSecureHash = request('vnp_SecureHash');
        $vnpHashSecret = config('services.VNPay.vnp_HashSecret');

        $inputData = array();
        foreach (request()->query() as $key => $value) {
            if (substr($key, 0, 4) == 'vnp_') {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = '';

        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . '=' . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . '=' . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnpHashSecret);

        if ($secureHash != $vnpSecureHash) {
            $message = 'Chữ ký không hợp lệ!';
            return view('client.orders.thank-you', [
                'message' => $message,
            ]);
        }

        if (request('vnp_ResponseCode') != '00') {
            $message = 'Giao dịch không thành công!';
            return view('client.orders.thank-you', [
                'message' => $message,
            ]);
        }

        Order::where('tracking_number', request('vnp_TxnRef'))->update([
            'payment_status' => 'Thành công'
        ]);
        Cart::where('user_id', Auth::user()->id)->delete();

        return view('client.orders.thank-you', [
            'message' => $message,
        ]);

    }
}
