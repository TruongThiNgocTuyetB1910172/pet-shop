@extends('admin.layouts.app')

@section('title','Danh sách phiếu nhập ')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="mb-3 mt-3">
                <a href="{{ route('receipt.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>Thêm phiếu nhập</a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách phiếu nhập</h3>
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
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Mã phiếu nhập</th>
                            <th>Người nhập</th>
                            <th>Tổng cộng</th>
                            <th>Trạng thái</th>
                            <th>Ghi chú</th>
                            <th>Ngày thêm</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($receipts->count() > 0)
                            @foreach ($receipts as $receipt)
                                <tr>
                                    <td>{{ $receipt->id }}</td>
                                    <td>{{ $receipt->tracking_number }}</td>
                                    <td>{{ $receipt->admin->name }}</td>
                                    <td>{{ CurrencyHelper::format( $receipt->total) }}</td>
                                    @if($receipt->status == 'pending')
                                        <td><span class="badge badge-warning">Đang chờ duyệt</span></td>
                                    @elseif($receipt->status == 'accepted')
                                        <td><span class="badge badge-primary">Đã duyệt</span></td>
                                    @endif
                                    <td style="max-width: 150px;" class="text-truncate">{{ $receipt->notes }}</td>
                                    <td>{{ $receipt->created_at->format('d')}} - {{$receipt->created_at->format('m')}} -
                                        {{ $receipt->created_at->format('Y')}}
                                        <small>{{ $receipt->created_at->format('g:i A') }}</small></td>

                                    <td>
                                        @if($receipt->status == 'pending')
                                        <a class="btn btn-primary btn-sm"
                                           href="{{ route('receipt.edit', ['id' => $receipt->id]) }}">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm"
                                           href="{{ route('receipt.delete', ['id' => $receipt->id]) }}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        @else
                                        <a class="btn btn-primary btn-sm"
                                           href="{{ route('receipt.detail', ['id' => $receipt->id]) }}">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                        @endif
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
                    <div class="my-3 mx-3">
                        {{ $receipts->links() }}
                    </div>
                </div>
            </div>
        </div>
@endsection
