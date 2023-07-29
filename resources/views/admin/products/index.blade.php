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
                        <th>Category</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $item)
                        <tr>
                            <th>{{$item->id}}</th>
                            <td>{{$item->name}}</td>
                            <td>{{$item->category->name}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="#">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
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
