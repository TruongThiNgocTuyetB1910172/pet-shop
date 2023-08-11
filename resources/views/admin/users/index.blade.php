@extends('admin.layouts.app')

@section('title','Danh sách người dùng')

@section('content')
    <div class="mb-3">
        <a href="{{ route('user.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>Thêm mới người dùng</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <h4>Danh sách người dùng</h4>
                    <hr>
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tên người dùng</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Quyền</th>
                        <th>Ngày thêm</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th>{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            @if($user->is_admin === 1)
                                <td><span class="badge badge-success">Admin</span></td>
                            @else
                                <td><span span class="badge badge-primary">User</span></td>
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

                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
