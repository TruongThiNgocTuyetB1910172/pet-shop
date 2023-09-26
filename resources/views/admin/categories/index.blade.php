@extends('admin.layouts.app')

@section('title', 'Danh sách danh mục')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="mb-3">
                <a href="{{ route('category.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>Thêm danh mục</a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách danh mục</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 500px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

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
                            <th>ID</th>
                            <th>Tên danh mục</th>
                            <th>Số sản phẩm</th>
                            <th>Ngày thêm</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($categories->count() > 0)
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name}}</td>
                                    <td>{{ $category->products->count() }}</td>
                                    <td>{{$category->created_at->format('d')}} - {{$category->created_at->format('m')}}
                                       {{$category->created_at->format('Y')}} <small>{{ $category->created_at->format('g:i A') }}</small>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ route('category.edit', ['id' => $category->id]) }}">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="{{ route('category.destroy', ['id' => $category->id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa không?')">
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
                    {{ $categories->links() }}
                </div>
            </div>
    </div>
@endsection
