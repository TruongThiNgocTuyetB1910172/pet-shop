@extends('admin.layouts.app')

@section('title', 'Danh sách danh mục')

@section('content')
    <div class="mb-3">
        <a href="{{ route('category.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>Thêm danh mục</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <div >
                    <h4>Danh sách danh mục</h4>
                    <hr>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Id</th>
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
                                <th>{{ $category->id }}</th>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->products->count() }}</td>
                                <td>{{$category->created_at->format('d')}} - {{$category->created_at->format('m')}} -
                                    {{$category->created_at->format('Y')}} <small>{{ $category->created_at->format('g:i A') }}</small>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('category.edit', ['id' => $category->id]) }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="{{ route('category.destroy', ['id' => $category->id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
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
