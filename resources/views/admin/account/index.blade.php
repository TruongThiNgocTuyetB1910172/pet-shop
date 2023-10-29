@extends('admin.layouts.app')

@section('title','Danh sách tài khoản')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="mb-3 mt-3">
                <a href="{{ route('account.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>Thêm tài khoản</a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách tài khoản</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 500px;">
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
                            <th>Tên người dùng</th>
                            <th>Hình ảnh</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Giới tính </th>
                            <th>Quyền</th>
                            <th>Ngày thêm</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($accounts->count() > 0)
                            @foreach ($accounts as $account)
                                <tr>
                                    <th>{{ $account->id }}</th>
                                    <td>{{ $account->name }}</td>
                                    <td><img src="{{ asset('storage/' . $account->image) }}" alt="{{ $account->name }}"
                                             width="50px" height="50px"></td>
                                    <td>{{ $account->email }}</td>
                                    <td>{{ $account->phone }}</td>
                                    @if($account->gender === 1)
                                        <td><span class="badge badge-success">Nam</span></td>
                                    @else
                                        <td><span span class="badge badge-primary">Nữ</span></td>
                                    @endif
                                    @if($account->role == 'admin')
                                        <td><span class="badge badge-success">Người quản trị</span></td>
                                    @elseif($account->role == 'employee')
                                        <td><span span class="badge badge-primary">Nhân viên nhập kho</span></td>
                                    @elseif($account->role == 'orderChecker')
                                        <td><span span class="badge badge-info">Nhân viên duyệt đơn</span></td>
                                    @endif
                                    <td>{{$account->created_at->format('d')}} - {{$account->created_at->format('m')}} -
                                        {{$account->created_at->format('Y')}} <small>{{ $account->created_at->format('g:i A') }}</small>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ route('account.edit', ['id' => $account->id]) }}">
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
                    {{ $accounts->links() }}
                </div>
            </div>
        </div>
@endsection
