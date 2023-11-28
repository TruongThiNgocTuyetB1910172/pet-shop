@extends('admin.layouts.app')

@section('title','Danh sách đơn hàng')

@section('content')
<div class="my-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách đơn hàng</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <form method="GET">
                                <input
                                    type="text"
                                    name="searchTerm"
                                    class="form-control float-right"
                                    placeholder="Search">
                            </form>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0" id="order-list">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Mã đơn hàng</th>
                            <th>Trạng thái</th>
                            <th>Trạng thái Shipper</th>
                            <th>Tổng tiền</th>
                            <th>Ngày đặt</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($orders->count() > 0)
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->tracking_number }}</td>
                                    @if($order->status === 'pending')
                                        <td><span class="badge badge-info">Chờ xác nhận</span></td>
                                    @elseif($order->status === 'accepted')
                                        <td><span class="badge badge-primary" >Đã duyệt đơn</span></td>
                                    @elseif($order->status === 'inDelivery')
                                        <td><span class="badge badge-warning">Đang vận chuyển</span></td>
                                    @elseif($order->status === 'success')
                                        <td><span class="badge badge-success" >Thành công</span></td>
                                    @elseif($order->status === 'cancel')
                                        <td><span class="badge badge-danger" >Hủy đơn</span></td>
                                    @else
                                        <td><span class="badge badge-dark">Hoàn tiền</span></td>
                                    @endif
                                    @if($order->order_shipper_status === 'pending')
                                        <td><span class="badge badge-info">Chờ xác nhận</span></td>
                                    @elseif($order->order_shipper_status === 'accepted')
                                        <td><span class="badge badge-primary" >Đã nhận đơn</span></td>
                                    @elseif($order->order_shipper_status === 'refuse')
                                        <td><span class="badge badge-danger">Từ chối nhận đơn</span></td>
                                    @elseif($order->order_shipper_status === 'success')
                                        <td><span class="badge badge-success" >Giao hàng thành công</span></td>
                                    @elseif($order->order_shipper_status === 'fail')
                                        <td><span class="badge badge-warning" >Giao hàng thất bại</span></td>
                                    @endif
                                    <td>{{ CurrencyHelper::format($order->total) }}</td>
                                    <td>{{ $order->created_at->format('d')}} - {{$order->created_at->format('m')}} -
                                        {{ $order->created_at->format('Y')}}
                                        <small>{{ $order->created_at->format('g:i A') }}</small></td>
{{--                                        <td>{{ $order->admin ? $order->admin->name : 'co ai cap nhat dau' }}</td>--}}
                                   @if($order->status == 'success')
                                        <td>
                                            <a class="btn btn-warning btn-sm"
                                               href="{{ route('order.show', ['id' => $order->id]) }}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    @else
                                        <td>
                                            <a class="btn btn-primary btn-sm"
                                               href="{{ route('order.edit', ['id' => $order->id]) }}">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </td>
                                   @endif
                                </tr>
                            @endforeach
                        </tbody>
                        @else
                            <div class="text-center mt-3 mb-3">
                                <strong>Không có dữ liệu nào được thêm vào</strong>
                            </div>
                        @endif
                    </table>
                    <div class="my-3 mx-3">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection


