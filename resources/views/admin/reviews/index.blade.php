@extends('admin.layouts.app')

@section('title','Danh sách sản phẩm')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="mb-3 mt-3">
{{--                <a href="{{ route('review.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>Thêm sản phẩm</a>--}}
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách binh luan</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <form method="GET">
                                <input
                                    type="text"
                                    name="searchTerm"
                                    class="form-control float-right"
                                    placeholder="Search">
                            </form>

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Tên khách hàng</th>
                            <th>Đánh giá</th>
                            <th>Sao</th>
                            <th>Trạng thái</th>
                            <th>Ngày thêm</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($reviews->count() > 0)
                            @foreach ($reviews as $review)
                                <tr>
                                    <td>{{ $review->id }}</td>
                                    <td>{{ $review->user->name}}</td>
                                    <td>{{ $review->comment }}</td>
                                    <td>
                                    @for ($i = 1; $i <= $review->rating; $i++)
                                        <i class="fa fa-star" style="color: #e3e32c ;margin-right: 2px"></i>
                                    @endfor
                                    </td>
                                    @if($review->status === 1)
                                        <td><span class="badge badge-warning">Hiển thị</span></td>
                                    @else
                                        <td><span class="badge badge-primary">Ẩn</span></td>
                                    @endif
                                    <td>{{ $review->created_at->format('d')}} - {{$review->created_at->format('m')}} -
                                        {{ $review->created_at->format('Y')}}
                                        <small>{{ $review->created_at->format('g:i A') }}</small></td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ route('review.edit', ['id' => $review->id]) }}">
                                            <i class="fa fa-pencil"></i>
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
                    <div class="my-3 mx-3">
                        {{ $reviews->links() }}
                    </div>
                </div>
            </div>
        </div>
@endsection
