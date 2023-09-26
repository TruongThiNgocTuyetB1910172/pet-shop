@extends('admin.layouts.app')

@section('title','Danh sách sản phẩm')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="mb-3">
            <a href="{{ route('product.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>Thêm sản phẩm</a>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Danh sách sản phẩm</h3>
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
                        <th>Id</th>
                        <th>Tên sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Danh mục</th>
                        <th>Trạng thái</th>
                        <th>Số lượng còn lại</th>
                        <th>Giá bán</th>
                        <th>Ngày thêm</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($products->count() > 0)
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td><img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                     width="50px" height="50px"></td>
                            <td>{{ $product->category->name }}</td>
                            @if($product->feature === 1)
                                <td><span class="badge badge-warning">Sản phẩm nổi bật</span></td>
                            @else
                                <td><span class="badge badge-primary">Sản phẩm thường</span></td>
                            @endif
                            <td>{{ $product->stock }}</td>
                            <td>{{ CurrencyHelper::format($product->selling_price) }}</td>
                            <td>{{ $product->created_at->format('d')}} - {{$product->created_at->format('m')}} -
                                {{ $product->created_at->format('Y')}}
                                <small>{{ $product->created_at->format('g:i A') }}</small></td>
                            <td>
                                <a class="btn btn-primary btn-sm"
                                   href="{{ route('product.edit', ['id' => $product->id]) }}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="{{ route('product.destroy', ['id' => $product->id]) }}"
                                   class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa không?')">
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
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
