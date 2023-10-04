<?php

namespace App\Http\Livewire;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
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

    public function checkout()
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
