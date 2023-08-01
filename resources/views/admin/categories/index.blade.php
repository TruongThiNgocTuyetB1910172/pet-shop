@extends("admin.layouts.app")
@section("content")
    <div class="mb-3">
        <a href="{{ route('category.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Create Category</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Count Products</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <th>{{ $category->id }}</th>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->products->count() }}</td>
                            <td>{{ $category->created_at }}</td>
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

                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection
