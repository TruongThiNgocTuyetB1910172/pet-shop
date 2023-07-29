@extends("admin.layouts.app")
@section("content")
    <div class="mb-3">
        <a href="{{ route('product.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Create Product</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Stock</th>
                        <th>Selling_price</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <th>{{$product->id}}</th>
                            <td>{{$product->name}}</td>
                            <td><img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="50px" height="50px"></td>
                            <td>{{$product->category->name}}</td>
                            <td>{{$product->stock}}</td>
                            <td>{{$product->selling_price}}</td>
                            <td>{{$product->created_at}}</td>
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

                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
