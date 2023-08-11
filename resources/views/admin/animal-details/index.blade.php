@extends('admin.layouts.app')
@section('title', 'Danh sách dịch vụ')
@section('content')
    <div class="mb-3">
        <a href="{{ route('animal-detail.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>Thêm
            mới </a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <div >
                    <h4>Danh sách chi tiet</h4>
                    <hr>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Danh mục loài</th>
                        <th>Giống loài</th>
                        <th>Cân nặng</th>
                        <th>Ngày thêm</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($animal_details->count() > 0)
                        @foreach ($animal_details as $animal_detail)
                            <tr>
                                <td>{{ $animal_detail->id }}</td>
                                <td>{{ $animal_detail->animal->name }}</td>
                                <td>{{ $animal_detail->variant }}</td>
                                <td>{{ $animal_detail->weight }}</td>
                                <td>{{ $animal_detail->created_at->format('d') }} - {{ $animal_detail->created_at->format('m') }} -
                                    {{ $animal_detail->created_at->format('Y') }}
                                    <small>{{ $animal_detail->created_at->format('g:i A') }}</small></td>
                                <td>
                                    <a class="btn btn-primary btn-sm"
                                       href="{{ route('animal-detail.edit', ['id' => $animal_detail->id]) }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="{{ route('animal-detail.destroy', ['id' => $animal_detail->id]) }}"
                                       class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
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
                {{ $animal_details->links() }}
            </div>
        </div>
    </div>
@endsection
