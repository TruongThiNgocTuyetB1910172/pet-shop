@extends("admin.layouts.app")
@section("content")
    <div class="mb-3">
        <a href="{{ route('district.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Create District</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Province</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($districts as $district)
                        <tr>
                            <th>{{ $district->id }}</th>
                            <td>{{ $district->name }}</td>
                            <td>{{ $district->province->name }}</td>
                            <td>{{ $district->created_at }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('district.edit', ['id' => $district->id]) }}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="{{ route('district.delete', ['id' => $district->id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $districts->links() }}
            </div>
        </div>
    </div>
@endsection
