@extends('admin.layouts.app')

@section('title','Danh sách người dùng')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="mb-3 mt-3">
            <a href="{{ route('user.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>Thêm khách hàng</a>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Danh sách khách hàng</h3>
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
                        <th>Tên người dùng</th>
                        <th>Hình ảnh</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Giới tính </th>
                        <th>Ngày thêm</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($users->count() > 0)
                        @foreach ($users as $user)
                        <tr>
                            <th>{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td><img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}"
                                     width="50px" height="50px"></td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            @if($user->gender === 1)
                                <td><span class="badge badge-success">Nam</span></td>
                            @else
                                <td><span span class="badge badge-primary">Nữ</span></td>
                            @endif
                            <td>{{$user->created_at->format('d')}} - {{$user->created_at->format('m')}} -
                                {{$user->created_at->format('Y')}} <small>{{ $user->created_at->format('g:i A') }}</small>
                            </td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('user.edit', ['id' => $user->id]) }}">
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
                <div class="my-3 mx-3">
                    {{ $users->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
