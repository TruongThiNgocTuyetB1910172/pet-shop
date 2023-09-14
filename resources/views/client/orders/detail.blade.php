@extends('client.layouts.app')


@section('content')

    <section class="sub-header shop-detail-1">
        <img class="rellax bg-overlay" src="client/images/sub-header/013.jpg" alt="">
        <div class="overlay-call-to-action"></div>
        <h3 class="heading-style-3">Order detail</h3>
    </section>
    <hr>
    <section class="boxed-sm">
        <div class="container">
                <div class="woocommerce">
                    <div class="row font-weight-bold text-uppercase">
                        <div class="col-md-9"><p>Thông tin chi tiết đơn hàng: #{{ $order->id }}</p></div>
                        <div class="col-md-3"><a class="btn btn-danger">Hủy đơn hàng</a></div>
                        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                    </div>
                    <form class="woocommerce-cart-form">
                        <table class="woocommerce-cart-table">
                                <thead>
                                <tr>
                                    <th class="product-quantity">Thời gian đặt:
                                    <p>{{$order->created_at->format('d')}} - {{$order->created_at->format('m')}} -
                                        {{$order->created_at->format('Y')}} <small>{{ $order->created_at->format('g:i A') }}</small></p>
                                    </th>
                                    <th class="product-thumbnail">Được giao bởi: <p>Chưa xác định</p></th>
                                    <th class="product-name">Trạng thái: <p>{{ $order->status }}</p></th>
                                    <th class="product-remove">Mã đơn hàng: <p> {{$order->tracking_number}} </p></th>
                                </tr>
                                </thead>
                        </table>
                        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                        <table class="table">
                            <div class="row">
                                @foreach($orderProduct as $item)
                                    <thead>
                                    <tr>
                                        <th class="col-md-2"><img src="{{( 'storage/'.$item->product->image) }}" height="80px" width="80px"></th>
                                        <th class="col-md-10">{{ $item->product->name}}
                                            <p>{{ CurrencyHelper::format($item->price) }} x {{ $item->quantity }} sản phẩm</p>
                                        </th>
                                    </tr>
                                    </thead>
                                @endforeach

                            </div>
                        </table>
                        <div class="row">
                            <div class="col-md-9">
                                <button class="btn btn-warning"><a href="{{ route('purchase.history') }}" } style="color: white">Quay về</a></button>
                            </div>
                            <div class="col-md-3" style="color: red">Tổng đơn: {{ CurrencyHelper::format($order->total) }}</div>
                        </div>
                    </form>
                    <hr>
                </div>
        </div>
    </section>
@endsection



