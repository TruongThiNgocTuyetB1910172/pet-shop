@extends('admin.layouts.app')
@section('content')
    <div class="mb-3">
        <a href="{{ route('user.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>Thêm mới người dùng</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
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
                            <td>{{ $user->is_admin === 1 ? 'Admin' : 'User' }}</td>
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
