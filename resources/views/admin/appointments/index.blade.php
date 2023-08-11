@extends('admin.layouts.app')

@section('title','Danh sách cuộc hẹn')

@section('content')
    <div class="mb-3">
        <a href="{{ route('appointment.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>Thêm mới cuộc hẹn </a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <h4>Danh sách cuộc hẹn</h4>
                    <hr>
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tên người dùng</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Lịch hẹn</th>
                        <th>Trạng thái</th>
                        <th>Ngày thêm</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($appointments->count() >0)
                    @foreach ($appointments as $appointment)
                        <tr>
                            <th>{{ $appointment->id }}</th>
                            <td>{{ $appointment->name }}</td>
                            <td>{{ $appointment->email }}</td>
                            <td>{{ $appointment->phone }}</td>
                            <td>{{ $appointment->appointment_at }}</td>
                            @if($appointment->status === 1)
                                <td><span class="badge badge-success">Đã xử lý</span></td>
                            @else
                                <td><span span class="badge badge-danger">Chưa Xử lý</span></td>
                            @endif
                            <td>{{$appointment->created_at->format('d')}} - {{$appointment->created_at->format('m')}} -
                                {{$appointment->created_at->format('Y')}} <small>{{ $appointment->created_at->format('g:i A') }}</small>
                            </td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('appointment.edit', ['id' => $appointment->id]) }}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="{{ route('appointment.destroy', ['id' => $appointment->id]) }}"
                                   class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
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

                {{ $appointments->links() }}
            </div>
        </div>
    </div>
@endsection
