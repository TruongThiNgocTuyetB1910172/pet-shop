@extends('admin.layouts.app')
@section('title', 'Danh sách dịch vụ')
@section('content')
    <div class="mb-3">
        <a href="{{ route('service.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>Thêm
            mới dịch vụ</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <div >
                    <h4>Danh sách dịch vụ</h4>
                    <hr>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tên dịch vụ</th>
                        <th>Hình ảnh</th>
                        <th>Ngày thêm</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($services->count() > 0)
                        @foreach ($services as $service)
                            <tr>
                                <th>{{ $service->id }}</th>
                                <td>{{ $service->name }}</td>
                                <td><img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}"
                                         width="50px" height="50px"></td>
                                <td>{{$service->created_at->format('d')}} - {{$service->created_at->format('m')}} -
                                    {{$service->created_at->format('Y')}}
                                    <small>{{ $service->created_at->format('g:i A') }}</small></td>
                                <td>
                                    <a class="btn btn-primary btn-sm"
                                       href="{{ route('service.edit', ['id' => $service->id]) }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="{{ route('service.destroy', ['id' => $service->id]) }}"
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
                {{ $services->links() }}
            </div>
        </div>
    </div>
@endsection
