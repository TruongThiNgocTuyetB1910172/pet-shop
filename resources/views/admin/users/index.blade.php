@extends('admin.layouts.app')
@section('content')
    <div class="mb-3">
        <a href="{{ route('user.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Create User</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Is_admin</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th>{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->is_admin }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                {{--                                <a class="btn btn-primary btn-sm" href="{{ route('user.edit', ['id' => $user->id]) }}">--}}
                                {{--                                    <i class="fa fa-pencil"></i>--}}
                                {{--                                </a>--}}
                                <a href="{{ route('user.destroy', ['id' => $user->id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                    <i class="fa fa-trash"></i>
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
