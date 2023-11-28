@extends('client.layouts.app')

@section('content')
    <section class="boxed-sm">
        <div class="card">
            <div class="container">
                <div class="woocommerce">
                    <div class="row font-weight-bold text-uppercase">
                        <div class="col-md-9" style="margin: 20px"><p>Thông tin chi tiết đơn hàng: #{{ $order->id }}</p></div>
                        @if($order->status == 'pending')
                            <div class="col-md-3"><a href="{{ route('order.cancel', ['id'=> $order->id]) }}" class="btn btn-danger"> <i class="fa fa-times" aria-hidden="true"></i> Hủy đơn hàng</a></div>
                        @endif
                        @if($order->status === 'success')
                            <th>
                                @if($orderFeedbacks->count() >0)
                                    <p>  Đơn hàng đã được đánh giá</p>
                                @else
                                    <a type="button" data-toggle="modal" data-target="#exampleModal">
                                        Đánh giá đơn hàng
                                        <i class="fa fa-pencil-square-o" aria-hidden="true" style="margin: 20px"></i>
                                    </a>
                                @endif
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><b>Phản hồi chất lượng đơn hàng</b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('order-feedback.store', ['id' => $order->id]) }}" method="POST">
                                                    @csrf
                                                    <div style="margin-bottom: 20px">
                                                        <h4>
                                                            Đánh giá của bạn
                                                        </h4>
                                                    </div>

                                                    <div class="rating my-4">
                                                        <input type="hidden" value="{{ $order->id }}" name="order_id">

                                                        <label>
                                                            <input type="radio" name="rating" value="1" />
                                                            <span class="fa fa-star icon"></span>
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="rating" value="2" />
                                                            <span class="fa fa-star icon"></span>
                                                            <span class="fa fa-star icon"></span>
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="rating" value="3" />
                                                            <span class="fa fa-star icon"></span>
                                                            <span class="fa fa-star icon"></span>
                                                            <span class="fa fa-star icon"></span>
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="rating" value="4" />
                                                            <span class="fa fa-star icon"></span>
                                                            <span class="fa fa-star icon"></span>
                                                            <span class="fa fa-star icon"></span>
                                                            <span class="fa fa-star icon"></span>
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="rating" value="5" />
                                                            <span class="fa fa-star icon"></span>
                                                            <span class="fa fa-star icon"></span>
                                                            <span class="fa fa-star icon"></span>
                                                            <span class="fa fa-star icon"></span>
                                                            <span class="fa fa-star icon"></span>
                                                        </label>
                                                    </div>
                                                    <div style="margin-bottom: 20px">
                                                        <h4>
                                                            Viết đánh giá:
                                                        </h4>
                                                    </div>
                                                    <textarea
                                                        class="form-control w-max" style="border-color: green; height: 150px;"
                                                        name="feedback" placeholder="Đánh giá của bạn *">
                                                                     </textarea>
                                                    <div style="margin-top: 20px">
                                                        <button class="btn btn-brand no-radius" type="submit">
                                                            Gửi đánh giá
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div></th>
                        @endif
                    </div>

                    <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                    <div class="woocommerce-cart-form">
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
                                @foreach($orderProducts as $key => $orderProduct)
                                    <thead>
                                    <tr>
                                        <th class="col-md-2"><a href="{{ route('product-list.detail', ['id' => $orderProduct->product->id]) }}"><img style="height: 70px; width: 70px" src="{{ asset('storage/'. $orderProduct->product->image )}}"></a></th>
                                        <th class="col-md-10" >{{ $orderProduct->product->name}}
                                            <p>{{ CurrencyHelper::format($orderProduct->price) }} x {{ $orderProduct->quantity }} sản phẩm</p>
                                        </th>
                                        @if($orderProduct->order->status == 'success')
                                            <th><a href="{{ route('comment-product.commentOnProduct',['id' => $orderProduct->product_id])  }}" ><i class="fa fa-commenting" aria-hidden="true"></i></a></th>
                                        @endif
                                    </tr>
                                    </thead>
                                @endforeach

                            </div>
                        </table>
                        <div class="row">
                            <div class="col-md-9">
                                <button class="btn btn-brand no-radius"><a href="{{ route('purchase.history') }}" } style="color: ghostwhite">Quay về</a></button>
                                <button class="btn btn-brand no-radius"><a href="{{ route('product-list.index') }}" style="color: ghostwhite">Tiếp tục mua hàng</a></button>
                            </div>
                            <div class="col-md-3" style="color: red">Tổng đơn: {{ CurrencyHelper::format($order->total) }}</div>
                        </div>
                        <div style="margin-top: 20px">
                            @if($order->status == 'success')
                                <div class="card">
                                    <div class="card-header">
                                        <p>Phản hồi đơn hàng</p>
                                    </div>
                                    <div class="card-body" style="margin-left: 20px">
                                        @foreach($orderFeedbacks as $orderFeedback)
                                            @for ($i = 1; $i <= $orderFeedback->rating; $i++)
                                                <i class="fa fa-star" style="color: #e3e32c ;margin-right: 2px"></i>
                                            @endfor
                                            <p >{{ $orderFeedback->feedback }}</p>

                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </section>

   <style>
       @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');body{background-color: #eeeeee;font-family: 'Open Sans',serif}.container{margin-top:50px;margin-bottom: 50px}.card{position: relative;display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;-ms-flex-direction: column;flex-direction: column;min-width: 0;word-wrap: break-word;background-color: #fff;background-clip: border-box;border: 1px solid rgba(0, 0, 0, 0.1);border-radius: 0.10rem}.card-header:first-child{border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0}.card-header{padding: 0.75rem 1.25rem;margin-bottom: 0;background-color: #fff;border-bottom: 1px solid rgba(0, 0, 0, 0.1)}.track{position: relative;background-color: #ddd;height: 7px;display: -webkit-box;display: -ms-flexbox;display: flex;margin-bottom: 60px;margin-top: 50px}.track .step{-webkit-box-flex: 1;-ms-flex-positive: 1;flex-grow: 1;width: 25%;margin-top: -18px;text-align: center;position: relative}.track .step.active:before{background: #FF5722}.track .step::before{height: 7px;position: absolute;content: "";width: 100%;left: 0;top: 18px}.track .step.active .icon{background: #ee5435;color: #fff}.track .icon{display: inline-block;width: 40px;height: 40px;line-height: 40px;position: relative;border-radius: 100%;background: #ddd}.track .step.active .text{font-weight: 400;color: #000}.track .text{display: block;margin-top: 7px}.itemside{position: relative;display: -webkit-box;display: -ms-flexbox;display: flex;width: 100%}.itemside .aside{position: relative;-ms-flex-negative: 0;flex-shrink: 0}.img-sm{width: 80px;height: 80px;padding: 7px}ul.row, ul.row-sm{list-style: none;padding: 0}.itemside .info{padding-left: 15px;padding-right: 7px}.itemside .title{display: block;margin-bottom: 5px;color: #212529}p{margin-top: 0;margin-bottom: 1rem}.btn-warning{color: #ffffff;background-color: #ee5435;border-color: #ee5435;border-radius: 1px}.btn-warning:hover{color: #ffffff;background-color: #ff2b00;border-color: #ff2b00;border-radius: 1px}
   </style>
@endsection
@section('styles')
    <style>
        .rating {
            display: inline-block;
            position: relative;
            height: 50px;
            line-height: 50px;
            font-size: 25px;
        }

        .rating label {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            cursor: pointer;
        }

        .rating label:last-child {
            position: static;
        }

        .rating label:nth-child(1) {
            z-index: 5;
        }

        .rating label:nth-child(2) {
            z-index: 4;
        }

        .rating label:nth-child(3) {
            z-index: 3;
        }

        .rating label:nth-child(4) {
            z-index: 2;
        }

        .rating label:nth-child(5) {
            z-index: 1;
        }

        .rating label input {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
        }

        .rating label .icon {
            float: left;
            color: transparent;
        }

        .rating label:last-child .icon {
            color: black;
        }

        .rating:not(:hover) label input:checked ~ .icon,
        .rating:hover label:hover input ~ .icon {
            color: #ffa904;
        }

        .rating label input:focus:not(:checked) ~ .icon:last-child {
            color: black;
            text-shadow: 0 0 5px #ffa904;
        }

        .scrollbar-deep-purple::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
            background-color: #F5F5F5;
            border-radius: 10px;
        }

        .scrollbar-deep-purple::-webkit-scrollbar {
            width: 12px;
            background-color: #F5F5F5;
        }

        .scrollbar-deep-purple::-webkit-scrollbar-thumb {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
            background-color: #96ad76;
        }

        .scrollbar-deep-purple {
            scrollbar-color: #96ad76 #F5F5F5;
        }

        .bordered-deep-purple::-webkit-scrollbar-track {
            -webkit-box-shadow: none;
            border: 1px solid #96ad76;
        }

        .bordered-deep-purple::-webkit-scrollbar-thumb {
            -webkit-box-shadow: none;
        }

        .square::-webkit-scrollbar-track {
            border-radius: 0 !important;
        }

        .square::-webkit-scrollbar-thumb {
            border-radius: 0 !important;
        }

        .thin::-webkit-scrollbar {
            width: 6px;
        }

        .example-1 {
            position: relative;
            overflow-y: scroll;
            height: 300px;
        }
    </style>
@endsection



