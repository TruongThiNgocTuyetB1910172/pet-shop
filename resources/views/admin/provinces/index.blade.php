@extends("admin.layouts.app")
@section("content")
    <div class="mb-3">
        <a href="{{ route('province.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Create Province</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($provinces as $province)
                        <tr>
                            <th>{{$province->id}}</th>
                            <td>{{$province->name}}</td>
                            <td>{{$province->created_at}}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('province.edit', ['id' => $province->id]) }}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="{{ route('province.delete', ['id' => $province->id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $provinces->links() }}
            </div>
        </div>
    </div>
@endsection
