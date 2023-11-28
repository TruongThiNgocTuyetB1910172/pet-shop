@extends('admin.layouts.app')

@section('title','Danh sách shipper')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="mb-3 mt-3">
                <a href="{{ route('shipper.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>Thêm tài khoản</a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách shipper</h3>
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
                <div class="card-body table-responsive p-0">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Hình ảnh</th>
                            <th>Tên shipper</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Giới tính </th>
                            <th>Ngày thêm</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($shippers->count() > 0)
                            @foreach ($shippers as $shipper)
                                <tr>
                                    <th>{{ $shipper->id }}</th>
                                    <td><img src="{{ asset('storage/' . $shipper->image) }}" alt="{{ $shipper->name }}"
                                             width="50px" height="50px"></td>
                                    <td>{{ $shipper->name }}</td>
                                    <td>{{ $shipper->email }}</td>
                                    <td>{{ $shipper->phone }}</td>
                                    @if($shipper->gender === 1)
                                        <td><span class="badge badge-success">Nam</span></td>
                                    @else
                                        <td><span span class="badge badge-primary">Nữ</span></td>
                                    @endif
                                  <td>{{$shipper->created_at->format('d')}} - {{$shipper->created_at->format('m')}} -
                                        {{$shipper->created_at->format('Y')}} <small>{{ $shipper->created_at->format('g:i A') }}</small>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ route('shipper.edit', ['id' => $shipper->id]) }}">
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
                    {{ $shippers->links() }}
                </div>
            </div>
        </div>
@endsection
