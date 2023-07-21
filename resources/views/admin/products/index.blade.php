@extends("admin.layouts.app")
@section("content")
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
            @foreach ($categories as $item)
                <tr>
                    <th>{{$item->id}}</th>
                    <td>{{$item->name}}</td>
                    <td>{{$item->created_at}}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('category.edit', ['id' => $item->id]) }}">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a href="{{ route('category.delete', ['id' => $item->id]) }}" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
