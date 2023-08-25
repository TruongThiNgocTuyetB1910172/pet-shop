@extends('client.layouts.app')

@section('content')
    <section class="sub-header shop-detail-1">
        <img class="rellax bg-overlay" src="client/images/sub-header/015.jpg" alt="">
        <div class="overlay-call-to-action"></div>
        <h3 class="heading-style-3">Checkout</h3>
    </section>
    <hr>
    <section class="boxed-sm">
        <div class="container">
            @if ($cartItems->count() > 0)
                @php $total = 0;
                    $amount = 0;
                @endphp
                <div class="woocommerce">
                    <div class="row">
                        <form class="woocommerce-checkout">

                            <h4 style="margin-bottom: 20px">Billing Details</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group organic-form no-radius">
                                        <span name="name">Tên khách hàng: </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group organic-form no-radius">
                                        <span >Email khách hàng: </span>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group organic-form no-radius">
                                        <span >Số điện thoại khách hàng: </span>

                                    </div>
                                </div>
                            </div>

                            <div class="woocommerce-checkout-review-order">
                                <h4 style="margin-bottom: 20px">Your order</h4>

                                <table class="woocommerce-checkout-review-order-table">

                                    <thead>

                                    <tr>
                                        <th class="product-name">Sản phẩm</th>
                                        <th class="product-total">Giá mua</th>
                                        <th class="product-total">Tổng cộng</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $cartItems as $item )

                                        @php
                                            $total +=$item->product->selling_price* $item->quantity;
                                            $amount += $item->quantity
                                        @endphp
                                        <tr class="cart_item">
                                            <td class="product-name">{{ $item->product->name }}
                                                <span class="product-quantity">× {{ $item->quantity }}</span>
                                            </td>
                                            <td class="product-total">
                                                <span class="woocommerce-Price-currencySymbol">{{ CurrencyHelper::format($item->product->selling_price) }}</span>
                                            </td>
                                            <td class="product-total">
                                                <span class="woocommerce-Price-currencySymbol">{{ CurrencyHelper::format($item->product->selling_price*$item->quantity) }}</span>
                                            </td>

                                        </tr>

                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr class="order-total">
                                        <th>Tổng sản phẩm</th>
                                        <td colspan="2">
                                            <strong>
                                                                                    <span class="woocommerce-Price-amount amount">
                                                                                        <span
                                                                                            class="woocommerce-Price-currencySymbol"></span>{{number_format($amount,
                                                                                        0, '.',
                                                                                        '.')}} sp</span>
                                            </strong>
                                        </td>
                                    </tr>

                                    <tr class="order-total">
                                        <th>Tổng đơn hàng</th>
                                        <td colspan="2">
                                            <strong>
                                                                                    <span class="woocommerce-Price-amount amount">
                                                                                        <span
                                                                                            class="woocommerce-Price-currencySymbol"></span>{{number_format($total,
                                                                                        0, '.',
                                                                                        '.')}} VNĐ</span>
                                            </strong>
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
                                            <img src="images/icons/paypal-group-icon.png" alt="paypal">
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


@endsection
