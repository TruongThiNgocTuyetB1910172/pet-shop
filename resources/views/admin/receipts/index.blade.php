@extends('admin.layouts.app')

@section('title', 'Danh sách phiếu nhập')

@section('content')
    <div class="mb-3">
        <a href="{{ route('receipt.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>Thêm danh mục</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <div >
                    <h4>Danh sách phiếu nhập</h4>
                    <hr>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Mã phiếu nhập</th>
                        <th>Trạng thái</th>
                        <th>Chú thích</th>
                        <th>Tổng tiền</th>
                        <th>Ngày thêm</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($receipts->count() > 0)
                        @foreach ($receipts as $receipt)
                            <tr>
                                <th>{{ $receipt->id }}</th>
                                <td>{{ $receipt->tracking_number }}</td>
                                <td>{{ $receipt->status}}</td>
                                <td>{{ $receipt->notes}}</td>
                                <td>{{ $receipt->total}}</td>
                                <td>{{$receipt->created_at->format('d')}} - {{$receipt->created_at->format('m')}} -
                                    {{$receipt->created_at->format('Y')}} <small>{{ $receipt->created_at->format('g:i A') }}</small>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('receipt.edit', ['id' => $receipt->id]) }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="{{ route('receipt.destroy', ['id' => $receipt->id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        <i class="fa fa-trash"></i>
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

                {{ $receipts->links() }}
            </div>
        </div>
    </div>
@endsection
