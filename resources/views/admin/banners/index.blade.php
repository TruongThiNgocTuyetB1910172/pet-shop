@extends('admin.layouts.app')

@section('title', 'Danh sách banner')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="mb-3 mt-3">
            <a href="{{ route('banner.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>Thêm banner</a>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Danh sách banner</h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Hình ảnh</th>
                        <th>Trạng thái</th>
                        <th>Ngày thêm</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($banners->count() > 0)
                        @foreach ($banners as $banner)
                            <tr>
                                <td>{{ $banner->id }}</td>
                                <td><img src="{{( 'storage/'.$banner->image) }}" alt="photo"
                                         class="rounded avatar-xs" width="50px" height="50px">
                                </td>
                                @if($banner->status === 1)
                                    <td><span class="badge badge-success">Hiển thị</span></td>
                                @else
                                    <td><span span class="badge badge-danger">Không hiển thị</span></td>
                                @endif

                                <td>{{$banner->created_at->format('d')}} - {{$banner->created_at->format('m')}}
                                    {{$banner->created_at->format('Y')}} <small>{{ $banner->created_at->format('g:i A') }}</small>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('banner.edit', ['id' => $banner->id]) }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="{{ route('banner.destroy', ['id' => $banner->id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa không?')">
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
                <div class="my-3 mx-3">
                    {{ $banners->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
