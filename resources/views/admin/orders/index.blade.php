@extends('admin.layouts.app')

@section('title','Danh sách đơn hàng')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <div >
                    <h4>Danh sách đơn hàng</h4>
                    <hr>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Id</th>
                       <th>Mã đơn hàng</th>
                        <th>Trạng thái</th>
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
                                    <td><span class="badge badge-info">Pending</span></td>
                                @elseif($order->status === 'accepted')
                                    <td><span class="badge badge-primary" >Accepted</span></td>
                                @elseif($order->status === 'inDelivery')
                                    <td><span class="badge badge-warning">inDelivery</span></td>
                                @elseif($order->status === 'success')
                                    <td><span class="badge badge-success" >success</span></td>
                                @elseif($order->status === 'cancel')
                                    <td><span class="badge badge-danger" >cancel</span></td>
                                @else
                                    <td><span class="badge badge-dark">refund</span></td>
                                @endif
                                <td>{{ CurrencyHelper::format($order->total) }}</td>
                                <td>{{ $order->created_at->format('d')}} - {{$order->created_at->format('m')}} -
                                    {{ $order->created_at->format('Y')}}
                                    <small>{{ $order->created_at->format('g:i A') }}</small></td>
                                <td>
                                    <a class="btn btn-primary btn-sm"
                                       href="{{ route('order.edit', ['id' => $order->id]) }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                @else
                    <div class="text-center mt-3 mb-3">
                        <strong>Không có dữ liệu nào được thêm vào</strong>
                    </div>

                @endif
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection