@extends('client.layouts.app')

@section('content')

    <section class="sub-header shop-detail-1">
        <img class="rellax bg-overlay" src="client/images/sub-header/013.jpg" alt="">
        <div class="overlay-call-to-action"></div>
        <h3 class="heading-style-3">Giỏ hàng</h3>
    </section>
    <hr>
    <section class="boxed-sm">
        <div class="container">
            @if ($carts->count() > 0)
                @php $total = 0;
                        $subtotal = 0;
                @endphp
                <div class="woocommerce">
                    <div class="woocommerce-cart-form">
                        <table class="woocommerce-cart-table">
                            <thead>
                            <tr>
                                <th></th>
                                <th class="product-thumbnail">Sản phẩm</th>
                                <th class="product-price">Giá </th>
                                <th class="product-quantity">Số lượng</th>
                                <th class="product-subtotal">Tổng tiền</th>
                                <th class="product-remove"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($carts as $item)

                                @php
                                    $total +=$item->product->selling_price* $item->quantity;
                                    $subtotal= $total+25000
                                @endphp
                                <tr>
                                    <form  hidden id="formUpdateCart" action="{{ route('cart-update') }}" method="POST" id="update-qty">
                                        @csrf
                                        @method('PUT')
                                        <td class="product-thumbnail">
                                            <a href="{{ route('product-list.detail', ['id' => $item->product->id]) }}"> <img style="height: 70px; width: 70px" src="{{asset( 'storage/'. $item->product->image) }}"></a>
                                        </td>
                                        <td class="product-name" data-title="Product">
                                            <a class="product-name" >{{$item->product->name}}</a>
                                        </td>
                                        <td class="product-price" data-title="Price">{{ CurrencyHelper::format($item->product->selling_price) }}</td>
                                        <td class="cart-product-quantity" >
                                            @if($item->product->stock >= $item->quantity)
                                                <div class="input-group mb-3 flex" style="max-width: 120px;">
                                                    <div class="input-group-prepend p-2">
                                                        <button data-dec-product-id="{{ $item->id }}" value="-" id="decrease" class="decrease " type="button">&minus;</button>
                                                    </div>
                                                    <input type="text" class="text-center p-2" style="width: 60px" name="quantity" value="{{ $item->quantity }}" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                                    <div class="input-group-append p-2">
                                                        <button data-inc-product-id="{{ $item->id }}" value="+" id="increase" class="increase " type="button">&plus;</button>
                                                    </div>
                                                </div>
                                            @else
                                                <span>Out of stock</span>
                                            @endif
                                        </td>
                                        <td class="product-subtotal" data-title="Total">{{ CurrencyHelper::format($item->product->selling_price*$item->quantity) }}</td>
                                        <td class="product-remove">

                                            <a  href="{{ route('cart.destroy', ['id' => $item->id]) }}" style="cursor: pointer" class="remove"  aria-label="Remove this item">×</a>
                                        </td>
                                    </form>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="cart_totals" style="margin-bottom: 50px">
                        <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span>Tổng cộng:</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span>{{ CurrencyHelper::format($total) }}</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span>Vận chuyển:</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span>{{ CurrencyHelper::format(25000) }}</span>
                                    </div>

                                    <div class="col-md-6">
                                        <span style="color: red">Tổng thanh toán</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span style="color: red">{{ CurrencyHelper::format($subtotal) }}</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="proceed-to-checkout">
                                    <a class="btn btn-brand " href="{{ route('product-list.index') }}">Tiếp tục mua hàng</a>
                                    <a class="btn btn-brand " href="{{ route('order-product.index') }}">Thanh toán</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @else
                <div class="woocommerce" style="margin-bottom: 30px">
                    <h3 class="text-center">Không có sản phẩm nào.</h3>
                </div>
            @endif
        </div>
    </section>


@endsection
@section('scripts')
    <script type="text/javascript">
        $('.increase').on('click', function(e) {
            e.preventDefault()

            let url = $('#formUpdateCart').attr('action');
            let id = $(this).data('inc-product-id');

            $.ajax({
                url: url,
                method: 'PUT',
                data: {
                    id: id,
                    type: 'inc',
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    location.reload()
                },
                error: function (error) {
                    console.log(error)
                }
            })
        });
    </script>

    <script type="text/javascript">
        $('.decrease').on('click', function(e) {
            e.preventDefault()

            let url = $('#formUpdateCart').attr('action');
            let id = $(this).data('dec-product-id');

            $.ajax({
                url: url,
                method: 'PUT',
                data: {
                    id: id,
                    type: 'dec',
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    location.reload()
                },
                error: function (error) {
                    console.log(error)
                }
            })
        });
    </script>
@endsection

