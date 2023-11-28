<?php

namespace App\Http\Livewire;

use App\Models\Address;
use App\Mail\OrderMail;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;

class Checkout extends Component
{
    public $cartProducts;

    public $total;

    public $shippingAddresses;

    public $addressId;

    public $notes;

    protected $rules = [
        'addressId' => 'required',
        'notes' => 'nullable',
    ];

    protected $messages = [
        'addressId.required' => 'Nhập địa chỉ của bạn',
        'notes.max' => 'Tối đa 1024 ký tự.',
    ];

    public function mount()
    {
        $shippingAddresses = Address::where('user_id', Auth::user()->id)->get();
        if ($shippingAddresses->count() === 0) {
            toast('Vui lòng thêm địa chỉ trước khi thanh toán.', 'warning');
            return redirect()->route('location.new-add');
        }
        $this->shippingAddresses = $shippingAddresses;

        $this->cartProducts = Cart::where('user_id', Auth::user()->id)->get();
        foreach ($this->cartProducts as $cartProduct) {
            $this->total += $cartProduct->product->selling_price * $cartProduct->quantity;
        }
    }

    public function checkoutVNPAY()
    {
        $validatedData = $this->validate();

        $vnp_Url = 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html';
        $vnp_Returnurl = 'https://pet-shop.com/order-paymentCallback';
        $vnp_TmnCode = config('services.VNPay.vnp_TmnCode');
        $vnp_HashSecret = config('services.VNPay.vnp_HashSecret');

        $vnp_TxnRef = Str::upper('ORG' . Str::random(15));
        $vnp_OrderInfo = 'Thanh toan hoa don Pet Shop';
        $vnp_OrderType = 180000;
        $vnp_Amount = $this->total * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = request()->ip();
        $inputData = array(
            'vnp_Version' => '2.1.0',
            'vnp_TmnCode' => $vnp_TmnCode,
            'vnp_Amount' => $vnp_Amount,
            'vnp_Command' => 'pay',
            'vnp_CreateDate' => date('YmdHis'),
            'vnp_CurrCode' => 'VND',
            'vnp_IpAddr' => $vnp_IpAddr,
            'vnp_Locale' => $vnp_Locale,
            'vnp_OrderInfo' => $vnp_OrderInfo,
            'vnp_OrderType' => $vnp_OrderType,
            'vnp_ReturnUrl' => $vnp_Returnurl,
            'vnp_TxnRef' => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != '') {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != '') {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        ksort($inputData);
        $query = '';
        $i = 0;
        $hashdata = '';
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . '=' . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . '=' . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . '=' . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . '?' . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        $selectAddress = Address::where('id', $this->addressId)->firstOrFail();
        $userName = $selectAddress->user_name;
        $houseNumber = $selectAddress->house_number;
        $phoneNumber = $selectAddress->phone_number;
        $ward = $selectAddress->ward->name;
        $district = $selectAddress->district->name;
        $province = $selectAddress->province->name;
        $shippingAddresses = $userName . ', ' .$phoneNumber. ', ' . $houseNumber . ', ' . $ward . ', ' . $district . ', ' . $province;

        $order = Order::create([
            'notes' => $validatedData['notes'],
            'user_id' => Auth::user()->id,
            'tracking_number' => Str::upper('ORG' . Str::random(15)),
            'status' => 'pending',
            'shipping_address' => $shippingAddresses,
            'total' => $this->total,
            'payment_type' => 'VNPAY',
            'payment_status' => 'Thành công',

        ]);

        foreach ($this->cartProducts as $product) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $product->product->id,
                'quantity' => $product->quantity,
                'price' => $product->product->selling_price,
            ]);

            $findProduct = Product::getProductById($product->product->id);

            $findProduct->update([
                'stock' => $findProduct->stock - $product->quantity,
            ]);
        }

        return redirect($vnp_Url)->with([
            'code' => '00',
            'message' => 'success',
        ]);
    }

    public function checkoutCOD()
    {
        $data = $this->validate();

        $selectAddress = Address::where('id', $this->addressId)->firstOrFail();
        $userName = $selectAddress->user_name;
        $houseNumber = $selectAddress->house_number;
        $phoneNumber = $selectAddress->phone_number;
        $ward = $selectAddress->ward->name;
        $district = $selectAddress->district->name;
        $province = $selectAddress->province->name;
        $shippingAddresses = $userName . ', ' .$phoneNumber. ', ' . $houseNumber . ', ' . $ward . ', ' . $district . ', ' . $province;

        $order = Order::create([
            'notes' => $data['notes'],
            'user_id' => Auth::user()->id,
            'tracking_number' => Str::upper('ORG' . Str::random(15)),
            'status' => 'pending',
            'shipping_address' => $shippingAddresses,
            'total' => $this->total,
            'payment_type' => 'COD',
            'payment_status' => '0',
        ]);

        foreach ($this->cartProducts as $product) {
           OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $product->product->id,
                'quantity' => $product->quantity,
                'price' => $product->product->selling_price,
            ]);

            $findProduct = Product::getProductById($product->product->id);

            $findProduct->update([
                'stock' => $findProduct->stock - $product->quantity,
            ]);
        }
        Mail::to($order->user->email)->send(new OrderMail($order));

        Cart::where('user_id', Auth::user()->id)->delete();

        toast('Đặt hàng thành công', 'success');

        return redirect()->route('order.thank-you');
    }

    public function render(): View
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        $addresses = Address::where('user_id', Auth::user()->id)->get();

        foreach ($carts as $item) {
            if(! Product::where('id', $item->product_id)->where('stock', '>=', $item->quantity)->exists()) {
                $removeItem = Cart::where('user_id', Auth::user()->id)->where('product_id', $item->product_id)->first();
                $removeItem -> delete();
            }
        }

        $cartItems = Cart::where('user_id', Auth::user()->id)->get();

        return view('livewire.checkout', compact('cartItems', 'addresses'));
    }
}
