@extends("admin.layouts.app")
@section("content")
    <div class="mb-3">
        <a href="{{ route('ward.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Create Ward</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>District</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($wards as $ward)
                        <tr>
                            <th>{{ $ward->id }}</th>
                            <td>{{ $ward->name }}</td>
                            <td>{{ $ward->district->name }}</td>
                            <td>{{ $ward->created_at }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('ward.edit', ['id' => $ward->id]) }}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="{{ route('ward.delete', ['id' => $ward->id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $wards->links() }}
            </div>
        </div>
    </div>
@endsection
