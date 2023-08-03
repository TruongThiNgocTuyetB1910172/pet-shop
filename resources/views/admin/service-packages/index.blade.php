@extends('admin.layouts.app')
@section('content')
    <div class="mb-3">
        <a href="{{ route('package-service.create') }}" class="btn btn-primary"><i class="fa fa-plus"
                                                                                   aria-hidden="true"></i>Thêm mới gói
            dịch vụ</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <div >
                    <h4>Danh sách gói dịch vụ</h4>
                    <hr>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tên dịch vụ</th>
                        <th>Hình ảnh</th>
                        <th>Giá bán</th>
                        <th>Ngày thêm</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($servicePackages->count() > 0)
                        @foreach ($servicePackages as $servicePackage)
                            <tr>
                                <th>{{ $servicePackage->id }}</th>
                                <td>{{ $servicePackage->name }}</td>
                                <td><img src="{{ asset('storage/' . $servicePackage->image) }}"
                                         alt="{{ $servicePackage->name }}" width="50px" height="50px"></td>
                                <td>{{ CurrencyHelper::format($servicePackage->selling_price) }}</td>
                                <td>{{ $servicePackage->created_at->format('d') }}
                                    - {{ $servicePackage->created_at->format('m') }} -
                                    {{ $servicePackage->created_at->format('Y') }}
                                    <small>{{ $servicePackage->created_at->format('g:i A') }}</small></td>
                                <td>
                                    <a class="btn btn-primary btn-sm"
                                       href="{{ route('package-service.edit', ['id' => $servicePackage->id]) }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="{{ route('package-service.destroy', ['id' => $servicePackage->id]) }}"
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
                {{ $servicePackages->links() }}
            </div>
        </div>
    </div>
@endsection
