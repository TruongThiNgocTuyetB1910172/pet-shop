@extends('client.layouts.app')

@section('content')

    <hr>
    <section class="boxed-sm">
        <div class="container">
                <div class="woocommerce">
                    <div class="row font-weight-bold text-uppercase">
                        <div class="col-md-9"><p>Thông tin chi tiết đơn hàng: #{{ $order->id }}</p></div>
                        @if($order->status == 'pending')
                            <div class="col-md-3"><a href="{{ route('order.cancel', ['id'=> $order->id]) }}" class="btn btn-danger"> <i class="fa fa-times" aria-hidden="true"></i> Hủy đơn hàng</a></div>
                        @endif
                    </div>
{{--                    @if($order->status === 'success')--}}
{{--                        <th>--}}
{{--                            <a type="button" data-toggle="modal" data-target="#exampleModal">--}}
{{--                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>--}}
{{--                                <p>Danh gia don hang</p>--}}
{{--                            </a>--}}
{{--                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--                                <div class="modal-dialog" role="document">--}}
{{--                                    <div class="modal-content">--}}
{{--                                        <div class="modal-header">--}}
{{--                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>--}}
{{--                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                                <span aria-hidden="true">&times;</span>--}}
{{--                                            </button>--}}
{{--                                        </div>--}}
{{--                                        <form action="{{ route('order-review', ['id' => $order->id]) }}" method="POST">--}}
{{--                                            @csrf--}}
{{--                                            @method('PUT')--}}
{{--                                            <div class="modal-body">--}}
{{--                                                <label>Comment:</label>--}}
{{--                                                <textarea class="form-control w-auto" name="reviews"></textarea>--}}
{{--                                            </div>--}}
{{--                                            <div class="modal-footer">--}}
{{--                                                --}}{{--                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                                                <button type="submit" class="btn btn-primary" >Save changes</button>--}}
{{--                                            </div>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div></th>--}}
{{--                    @endif--}}
                    <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                    <form class="woocommerce-cart-form">
                        <table class="woocommerce-cart-table" style="background-color: white">
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


                        <div class="track">
                            @if($order->status == 'pending')
                                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Đang chờ duyệt</span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Đã duyệt</span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Đang giao hàng</span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-archive" aria-hidden="true"></i> </span> <span class="text">Thành công</span> </div>
                            @elseif($order->status == 'accepted')
                                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Đang chờ duyệt</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Đã duyệt</span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Đang giao hàng</span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-archive" aria-hidden="true"></i> </span> <span class="text">Thành công</span> </div>
                            @elseif($order->status == 'inDelivery')
                                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Đang chờ duyệt</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Đã duyệt</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Đang giao hàng</span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-archive" aria-hidden="true"></i> </span> <span class="text">Thành công</span> </div>
                            @elseif($order->status == 'success')
                                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Đang chờ duyệt</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Đã duyệt</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Đang giao hàng</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-archive" aria-hidden="true"></i> </span> <span class="text">Thành công</span> </div>
                            @elseif($order->status == 'cancel')
                                <div class="step active"> <span class="icon"> <i class="fa fa-times" aria-hidden="true"></i> </span> <span class="text">Đơn hàng bị hủy</span> </div>
                            @elseif($order->status == 'refund')
                                <div class="step active"> <span class="icon"> <i class="fa fa-money" aria-hidden="true"></i> </span> <span class="text">Đơn hàng được hoàn tiền</span> </div>
                            @endif
                        </div>

                        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                        <table class="table">
                            <div class="row">
                                @foreach($orderProduct as $orderProduct)
                                    <thead>
                                    <tr>
                                        <th class="col-md-2"><img style="height: 70px; width: 70px" src="{{ asset('storage/'. $orderProduct->product->image )}}"></th>
                                        <th class="col-md-10" >{{ $orderProduct->product->name}}
                                            <p>{{ CurrencyHelper::format($orderProduct->price) }} x {{ $orderProduct->quantity }} sản phẩm</p>
                                        </th>
                                        <th></th>
                                       
'
                                    </tr>
                                    </thead>
                                @endforeach

                            </div>
                        </table>
                        <div class="row">
                            <div class="col-md-9">
                                <button class="btn btn-light"><a href="{{ route('purchase.history') }}" } style="color: black">Quay về</a></button>
                                <button class="btn btn-light"><a href="{{ route('product-list.index') }}" style="color: black">Tiếp tục mua hàng</a></button>
                            </div>
                            <div class="col-md-3" style="color: red">Tổng đơn: {{ CurrencyHelper::format($order->total) }}</div>
                        </div>
                    </form>
                    <hr>
                </div>
        </div>
    </section>

   <style>
       @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');body{background-color: #eeeeee;font-family: 'Open Sans',serif}.container{margin-top:50px;margin-bottom: 50px}.card{position: relative;display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;-ms-flex-direction: column;flex-direction: column;min-width: 0;word-wrap: break-word;background-color: #fff;background-clip: border-box;border: 1px solid rgba(0, 0, 0, 0.1);border-radius: 0.10rem}.card-header:first-child{border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0}.card-header{padding: 0.75rem 1.25rem;margin-bottom: 0;background-color: #fff;border-bottom: 1px solid rgba(0, 0, 0, 0.1)}.track{position: relative;background-color: #ddd;height: 7px;display: -webkit-box;display: -ms-flexbox;display: flex;margin-bottom: 60px;margin-top: 50px}.track .step{-webkit-box-flex: 1;-ms-flex-positive: 1;flex-grow: 1;width: 25%;margin-top: -18px;text-align: center;position: relative}.track .step.active:before{background: #FF5722}.track .step::before{height: 7px;position: absolute;content: "";width: 100%;left: 0;top: 18px}.track .step.active .icon{background: #ee5435;color: #fff}.track .icon{display: inline-block;width: 40px;height: 40px;line-height: 40px;position: relative;border-radius: 100%;background: #ddd}.track .step.active .text{font-weight: 400;color: #000}.track .text{display: block;margin-top: 7px}.itemside{position: relative;display: -webkit-box;display: -ms-flexbox;display: flex;width: 100%}.itemside .aside{position: relative;-ms-flex-negative: 0;flex-shrink: 0}.img-sm{width: 80px;height: 80px;padding: 7px}ul.row, ul.row-sm{list-style: none;padding: 0}.itemside .info{padding-left: 15px;padding-right: 7px}.itemside .title{display: block;margin-bottom: 5px;color: #212529}p{margin-top: 0;margin-bottom: 1rem}.btn-warning{color: #ffffff;background-color: #ee5435;border-color: #ee5435;border-radius: 1px}.btn-warning:hover{color: #ffffff;background-color: #ff2b00;border-color: #ff2b00;border-radius: 1px}
   </style>
@endsection



