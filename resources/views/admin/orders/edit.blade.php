@extends('admin.layouts.app')

@section('title', 'Cập nhật đơn hàng')

@section('content')
    <div><h4 class="card-title text-uppercase">Cập nhật đơn hàng</h4></div>
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
                <div class="text-uppercase text-center"><h4>Thông tin chi tiêt đơn hàng</h4>
                </div><hr>
                <div class="row mb-2">
                        <div class="row col-6">
                            <div class="col-md-4 ">
                                <strong>Tên khách hàng: </strong>
                            </div>
                            <div class="form-group col-md-8">
                                <input class="form-control" type="text" value="{{$order->user->name}}" readonly="readonly">
                            </div>
                        </div>
                        <div class="row col-6">
                            <div class="col-md-4 ">
                                <strong>Số điện thoại: </strong>
                            </div>
                            <div class="form-group col-md-8">
                                <input class="form-control" type="text" value="{{$order->user->phone}}" readonly="readonly">
                            </div>
                        </div>
                    </div>
                <div class="row mb-2">
                    <div class="row col-6">
                        <div class="col-md-4 ">
                            <strong>Tổng đơn hàng: </strong>
                        </div>
                        <div class="form-group col-md-8">
                            <input class="form-control" type="text" value="{{ CurrencyHelper::format($order->total) }}" readonly="readonly">
                        </div>
                    </div>
                    <div class="row col-6">
                        <div class="col-md-4 ">
                            <strong>Phương thức thanh toán: </strong>
                        </div>
                        <div class="form-group col-md-8">
                            <input class="form-control" type="text" value="Thanh toán bằng tiền mặc" readonly="readonly">
                        </div>
                    </div>

                </div>
                <div class="row mb-2">
                    <div class="row col-6">
                        <div class="col-md-4 ">
                            <strong>Thời gian đặt hàng: </strong>
                        </div>
                        <div class="form-group col-md-8">
                            <p class="form-control">{{$order->created_at->format('d')}} - {{$order->created_at->format('m')}} -
                                {{$order->created_at->format('Y')}} <small>{{ $order->created_at->format('g:i A') }}</small></p>
                        </div>
                    </div>
                    <div class="row col-6">
                        <div class="col-md-4 ">
                            <strong>Thời gian cập nhật: </strong>
                        </div>
                        <div class="form-group col-md-8">
                            <p class="form-control">{{$order->updated_at->format('d')}} - {{$order->updated_at->format('m')}} -
                                {{$order->updated_at->format('Y')}} <small>{{ $order->updated_at->format('g:i A') }}</small></p>
                        </div>
                    </div>

                </div>
                <div class="row mb-2">
                    <div class="row col-md-12">
                        <div class="col-md-2 ">
                            <strong>Địa chỉ nhận hàng: </strong>
                        </div>
                        <div class="form-group col-md-10">
                            <input class="form-control" type="text" value="{{ $order->shipping_address }}" readonly="readonly">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="basic-form">
                <div class="text-uppercase text-center"><h4>Danh sách sản phẩm của đơn hàng</h4>
                </div><hr>
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

    <div class="card">
        <div class="card-body">
            <div class="basic-form">
                <form action="{{ route('order.update', ['id' => $order->id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <div class="text-uppercase text-center"><h4>Xác nhận</h4></div>
                        <hr>
                        <p class="form-label text-center"> <strong>Trạng thái của đơn hàng: </strong></p>
                        <div>
                            <select class="form-control text-center " name="status" style="border: none">
                                <option>Chọn trạng thái đơn hàng</option>
                                @switch($order->status)
                                    @case('pending')
                                        <option value="pending" >Đang chờ duyệt</option>
                                    @case('accepted')
                                        <option value="accepted">Đã được duyệt</option>
                                    @case('inDelivery')
                                        <option value="inDelivery">Đang vận chuyển</option>
                                    @case('success')
                                        <option value="success">Thành công</option>
                                    @case('cancel')
                                        <option value="cancel" >Hủy bỏ</option>
                                    @case('refund')
                                        <option value="refund">Hoàn tiền</option>
                                        @break
                                @endswitch
                            </select>
                        </div>
                    </div>
                    <div class="form-group text-center mt-3">
                        <a  href="{{ route('order.index') }}" class="btn btn-light mb-2 ">Quay lại</a>
                        <button type="submit" class="btn btn-success mb-2">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
