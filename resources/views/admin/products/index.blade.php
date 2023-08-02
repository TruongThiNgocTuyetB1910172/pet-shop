@extends("admin.layouts.app")
@section("content")
    <div class="mb-3">
        <a href="{{ route('product.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>Thêm mới sản phẩm</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tên sẩn phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Danh mục</th>
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
                                <th>{{ $product->id }}</th>
                                <td>{{ $product->name }}</td>
                                <td><img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="50px" height="50px"></td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->selling_price }}</td>
                                <td>{{$product->created_at->format('d')}} - {{$product->created_at->format('m')}} -
                                    {{$product->created_at->format('Y')}} <small>{{ $product->created_at->format('g:i A') }}</small></td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('product.edit', ['id' => $product->id]) }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="{{ route('product.destroy', ['id' => $product->id]) }}"class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
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
