{{--@extends('admin.layouts.app')--}}
{{--@section('title', 'Danh sách biến thể dịch vụ')--}}
{{--@section('content')--}}
{{--    <div class="mb-3">--}}
{{--        <a href="{{ route('variant-service.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>Thêm--}}
{{--            mới dịch vụ</a>--}}
{{--    </div>--}}
{{--    <div class="card">--}}
{{--        <div class="card-body">--}}
{{--            <div class="table-responsive">--}}
{{--                <div >--}}
{{--                    <h4>Danh sách biến thể dịch vụ</h4>--}}
{{--                    <hr>--}}
{{--                </div>--}}
{{--                <table class="table">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th>Tên dịch vụ</th>--}}
{{--                        <th>Hình ảnh</th>--}}
{{--                        <th>Chi tiết</th>--}}
{{--                        <th>Giá</th>--}}
{{--                        <th>Hành động</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    @if($animalDetails->count() > 0)--}}
{{--                        @foreach ($animalDetails as $animalDetail)--}}
{{--                            <tr>--}}
{{--                                <td>{{ $animalDetail->services->name }}</td>--}}
{{--                                <td><img src="{{ asset('storage/' . $animalDetail->services->image) }}" alt="{{ $animalDetail->services->name }}"--}}
{{--                                         width="50px" height="50px"></td>--}}
{{--                                <td>{{$animalDetail->animal->name}}, weight:{{$animalDetail->weight}}</td>--}}
{{--                                    <a class="btn btn-primary btn-sm"--}}
{{--                                       href="{{ route('variant-service.edit', ['id' => $service->id]) }}">--}}
{{--                                        <i class="fa fa-pencil"></i>--}}
{{--                                    </a>--}}
{{--                                    <a href="{{ route('variant-services.destroy', ['id' => $service->id]) }}"--}}
{{--                                       class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">--}}
{{--                                        <i class="fa fa-trash"></i>--}}
{{--                                    </a>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}

{{--                    </tbody>--}}
{{--                </table>--}}

{{--                @else--}}
{{--                    <div class="text-center mt-3 mb-3">--}}
{{--                        <strong>Không có dữ liệu nào được thêm vào</strong>--}}
{{--                    </div>--}}

{{--                @endif--}}
{{--                {{ $services->links() }}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}
