@extends('client.layouts.app')

@section('content')
    <section class="sub-header shop-detail-1">
        <img class="rellax bg-overlay" src="client/images/sub-header/015.jpg" alt="">
        <div class="overlay-call-to-action"></div>
        <h3 class="heading-style-3">Thanh toán</h3>
    </section>
    <hr>
    <section class="boxed-sm " style="margin-bottom: 40px">
        <div class="container">
            @if ($cartItems->count() > 0)
                @php $total = 0;
                    $amount = 0;
                @endphp
                <div class="woocommerce">
                    <div class="row">
                        <form class="woocommerce-checkout">
{{--                            <div class="woocommerce-checkout-review-order col-md-12">--}}
{{--                                <h4 style="margin-bottom: 20px">Địa chỉ giao hàng</h4>--}}
{{--                                <table class="woocommerce-cart-table">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th class="product-thumbnail">DĐịa chỉ</th>--}}

{{--                                        <th class="product-remove"></th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    @foreach($addresses as $address)--}}
{{--                                        <tr>--}}

{{--                                               <td> <input type="checkbox" style="margin-right: 20px" >{{$address->user_name}}, {{$address->phone_number}}, {{$address->house_number}}, {{$address->ward->name}}, {{$address->district->name}}, {{$address->province->name}}</td>--}}
{{--                                                <td class="product-remove">--}}

{{--                                                    <a  href="#" style="cursor: pointer" class="remove"  aria-label="Remove this item">×</a>--}}
{{--                                                </td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}

{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}


                            <div style="margin-bottom: 20px" class="row">
                                <div class="col-md-6"><h4 style="color: red"><i class="fa fa-map-marker" aria-hidden="true"></i> Địa chỉ giao hàng <span>*</span></h4></div>
                                <div class="col-md-6"><a href="{{ route('location.new-add') }}">Thay đổi</a></div>

                            </div>
                            @if($addresses->count() >0)
                            @foreach($addresses as $address)
                            <div class="woocommerce-info">
                              <div class=row>
                                  <div class="col-md-6"><input type="checkbox" style="margin-right: 20px" >{{$address->user_name}}, {{$address->phone_number}}, {{$address->house_number}}, {{$address->ward->name}}, {{$address->district->name}}, {{$address->province->name}}</div>
                                  <div class="col-md-6 ">  <a href="{{ route('address.delete', ['id' => $address->id]) }} ">X</a></div>
                              </div>
                            </div>
                            @endforeach
                            @else
                                <div >
{{--                                    <strong><a href="{{ route('location.new-add') }}">Thêm địa chỉ trước khi đặt hàng</a></strong>--}}

                                    <livewire:location>

                                    </livewire:location>
                                </div>


                            @endif

                            <div class="woocommerce-checkout-review-order col-md-12">
                                <h4 style="margin-bottom: 20px">Sản phẩm</h4>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th class="product-name">Sản phẩm</th>
{{--                                        <th class="product-total">Đơn giá</th>--}}
                                        <th class="product-total">Thành tiền</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $cartItems as $item )
                                        @php
                                            $total +=$item->product->selling_price* $item->quantity;
                                            $amount += $item->quantity
                                        @endphp
                                        <tr class="cart_item">
                                            <td class="product-thumbnail">
                                                <img style="height: 70px; width: 70px" src="{{ 'storage/'. $item->product->image }}">
                                            </td>
                                            <td class="product-name" data-title="Product">
                                                <a class="product-name" >{{$item->product->name}}</a>
                                                <br>
                                                <span> x {{$item->quantity}}</span>
                                            </td>

{{--                                            <td class="product-price" data-title="Price">{{ CurrencyHelper::format($item->product->selling_price) }}</td>--}}
                                            <td class="product-subtotal" data-title="Total">{{ CurrencyHelper::format($item->product->selling_price*$item->quantity) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
{{--                                    <tr class="order-total">--}}
{{--                                        <th></th>--}}
{{--                                        <th></th>--}}
{{--                                        <th>Tổng tiền hàng</th>--}}
{{--                                        <td colspan="2" style="opacity: 0.6">--}}
{{--                                            {{number_format($total,0, '.', '.')}} VNĐ--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
                                    <tr>

                                        <th>Tổng thanh toán</th>
                                        <th></th>
                                        <td style="opacity: 0.6">
                                            {{number_format($total,0, '.', '.')}} VNĐ
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="woocommerce-checkout-payment">
                                <div class="payment_method_cheque">
                                    <div class="radio">
                                        <label>
                                            <input class="input-radio" id="payment_method_cheque" name="payment_method" value="cheque" checked="checked" type="radio">Check Payments
                                            <div class="payment_box payment_method_cheque">
                                                <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="payment_method_paypal">
                                    <div class="radio">
                                        <label>
                                            <input class="input-radio" id="payment_method_paypal" name="payment_method" value="paypal" type="radio"> PayPal
                                            <img src="client/images/icons/paypal-group-icon.png" alt="paypal">
                                            <a href="#">What is Paypal? </a>
                                            <div class="payment_box payment_method_cheque">
                                                <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-place-order">
                                    <noscript>Since your browser does not support JavaScript, or it is disabled, please ensure you click the
                                        <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.
                                        <br>
                                        <input class="button alt" type="submit" name="woocommerce_checkout_update_totals" value="Update totals">
                                    </noscript>
                                    <input class="place_order btn btn-brand pill" name="woocommerce_checkout_place_order" value="PLACE ORDER" data-value="Place order" type="submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function (){
            $('#province').change(function (){
                let province_id = $(this). val();
                $.ajax ({
                    url: 'get-district',
                    type: 'POST',
                    data: {
                        province_id: province_id,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#district').html(result)
                    },

                })
            });
            $('#district').change(function (){
                let district_id = $(this). val();

                $.ajax ({
                    url: 'get-ward',
                    type: 'POST',
                    data: {
                        district_id: district_id,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (result) {
                        $('#ward').html(result)
                    },
                })
            });
        })
    </script>
@endsection
