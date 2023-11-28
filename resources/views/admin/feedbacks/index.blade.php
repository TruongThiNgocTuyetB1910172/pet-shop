@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="mb-3 mt-3">
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách phản hồi</h3>
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
                            <th>Ngày thêm</th>

                        </tr>
                        </thead>
                        <tbody>
                        @if($feedbacks->count() > 0)
                            @foreach ($feedbacks as $feedback)
                                <tr>
                                    <td>{{ $feedback->id }}</td>
                                    <td>{{ $feedback->user->name}}</td>
                                    <td>{{ $feedback->feedback }}</td>
                                    <td>
                                        @for ($i = 1; $i <= $feedback->rating; $i++)
                                            <i class="fa fa-star" style="color: #e3e32c ;margin-right: 2px"></i>
                                        @endfor
                                    </td>
                                    <td>{{ $feedback->created_at->format('d')}} - {{$feedback->created_at->format('m')}} -
                                        {{ $feedback->created_at->format('Y')}}
                                        <small>{{ $feedback->created_at->format('g:i A') }}</small></td>

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
                        {{ $feedbacks->links() }}
                    </div>
                </div>
            </div>
        </div>
@endsection
