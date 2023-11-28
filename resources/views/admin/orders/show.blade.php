@extends('admin.layouts.app')
@section('title', 'Cập nhật đơn hàng')
@section('content')
    <div class="my-3">
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title text-uppercase">Thông tin khách hàng</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="row col-6">
                                <div class="col-md-4 ">
                                    <strong>Tên khách hàng: </strong>
                                </div>
                                <div class="form-group col-md-8">
                                    <p class="form-control">{{ $order->user->name }}</p>
                                </div>
                            </div>
                            <div class="row col-6">
                                <div class="col-md-4 ">
                                    <strong>Số điện thoại: </strong>
                                </div>
                                <div class="form-group col-md-8">
                                    <p class="form-control" >{{ $order->user->phone }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="row col-6">
                                <div class="col-md-4 ">
                                    <strong>Tổng đơn hàng: </strong>
                                </div>
                                <div class="form-group col-md-8">
                                    <p class="form-control">{{ CurrencyHelper::format($order->total) }}</p>
                                </div>
                            </div>
                            <div class="row col-6">
                                <div class="col-md-4 ">
                                    <strong>Phương thức thanh toán: </strong>
                                </div>
                                <div class="form-group col-md-8">
                                    @if($order->payment_type === 'COD')
                                        <p class="form-control" >Thanh toán bằng tiền mặc</p>
                                    @elseif($order->payment_type === 'VNPAY')
                                        <p class="form-control" >Thanh toán bằng VNPAY</p>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="row col-6">
                                <div class="col-md-4 ">
                                    <strong>Thời gian đặt hàng: </strong>
                                </div>
                                <div class="form-group col-md-8">
                                    <p class="form-control">{{ $order->created_at->format('d') }} - {{ $order->created_at->format('m') }} -
                                        {{ $order->created_at->format('Y') }} <small>{{ $order->created_at->format('g:i A') }}</small></p>
                                </div>
                            </div>
                            <div class="row col-6">
                                <div class="col-md-4 ">
                                    <strong>Thời gian cập nhật: </strong>
                                </div>
                                <div class="form-group col-md-8">
                                    <p class="form-control">{{ $order->updated_at->format('d') }} - {{ $order->updated_at->format('m') }} -
                                        {{ $order->updated_at->format('Y') }} <small>{{ $order->updated_at->format('g:i A') }}</small></p>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="row col-md-12">
                                <div class="col-md-2 ">
                                    <strong>Địa chỉ nhận hàng: </strong>
                                </div>
                                <div class="form-group col-md-10">
                                    <p class="form-control">{{ $order->shipping_address }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="row col-md-12">
                                <div class="col-md-2 ">
                                    <strong>Ghi chú: </strong>
                                </div>
                                <div class="form-group col-md-10">
                                    <p class="form-control">{{ $order->notes }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
                <div class="text-uppercase text-center"><h4>Thông tin đơn hàng</h4>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th class="product-thumbnail">Sản phẩm</th>
                        <th class="product-name">Tên</th>
                        <th class="product-price">Giá</th>
                        <th class="product-quantity">Số lượng</th>
                        <th class="product-quantity">Tổng tiền</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orderProducts as $orderProduct)
                        <tr>
                            <td >
                                <img src="{{( 'storage/'.$orderProduct->product->image) }}" height="80px" width="80px">
                            </td>
                            <td>{{ $orderProduct->product->name }}</td>
                            <td>{{ CurrencyHelper::format($orderProduct->product->selling_price) }}</td>
                            <td>{{ $orderProduct->quantity }}</td>
                            <td>{{ CurrencyHelper::format($orderProduct->price) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-info">Tổng tiền: {{ CurrencyHelper::format($orderProduct->order->total) }}</div>
            </div>
        </div>
    </div>

    {{--    <div class="row">--}}
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
                <form action="{{ route('order.update', ['id' => $order->id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <div class="text-uppercase text-center"><h4>Xác nhận</h4></div>
                        <hr>
                    </div>
                    <div class="text-center" >Đơn hàng giao thành công</div>
                </form>
            </div>
        </div>
    </div>

@endsection
