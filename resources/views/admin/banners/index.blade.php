@extends('admin.layouts.app')
@section('content')
    <div class="mb-3">
        <a href="{{ route('banner.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Create Banner</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($banners as $banner)
                        <tr>
                            <th>{{ $banner->id }}</th>
                            <td><img src="{{( 'storage/'.$banner->image) }}" alt="photo"
                                     class="rounded avatar-xs" width="50px" height="50px">
                            </td>
                            <td>{{ $banner->created_at }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('banner.edit', ['id' => $banner->id]) }}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="{{ route('banner.destroy', ['id' => $banner->id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
