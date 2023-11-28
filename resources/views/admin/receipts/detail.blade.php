@extends('admin.layouts.app')

@section('title','Chi tiết phiếu nhập ')

@section('content')
    <div class="my-3">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card-primary col-6">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin</h3>
                        </div>
                        <div class="row mt-3 mx-2" >
                            <div class="col-3 ">
                                <strong>Người lập phiếu: </strong>
                            </div>
                            <div class="form-group col-9">
                                <p class="form-control">{{ $receipt->admin->name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-primary col-6">
                        <div class="card-header">
                            <h3 class="card-title">Nội dung</h3>
                        </div>
                        <div class="row mt-3 mx-2" >
                            <div class="col-3 ">
                                <strong>Ghi chú: </strong>
                            </div>
                            <div class="form-group col-9">
                                <p class="form-control">{{ $receipt->notes }}</p>
                            </div>
                        </div>
                        <div class="row mx-2" >
                            <div class="col-3 ">
                                <strong>Ngày duyệt: </strong>
                            </div>
                            <div class="form-group col-9">
                                <p class="form-control">{{ $receipt->created_at->format('d')}} - {{$receipt->created_at->format('m')}} -
                                    {{ $receipt->created_at->format('Y')}}
                                    <small>{{ $receipt->created_at->format('g:i A') }}</small></p>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách sản phẩm nhập</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-head-fixed text-nowrap">
                            @php $total = 0;
                                   $sum = 0;
                            @endphp
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Hình</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá nhập</th>
                                <th>Số lượng</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($receiptDetails->count() > 0)
                                @foreach($receiptDetails as $receiptDetail)
                                    @php
                                        $total +=$receiptDetail->quantity * $receiptDetail->price;
                                        $sum += $receiptDetail->quantity;
                                    @endphp
                                    <tr>
                                        <td>{{ $receiptDetail->id }}</td>
                                        <td><img src="{{ asset('storage/' . $receiptDetail->product->image) }}" alt="{{ $receiptDetail->product->name }}"
                                                 width="50px" height="50px"></td>
                                        <td>{{ $receiptDetail->product->name }}</td>
                                        <td>
                                            {{ $receiptDetail->price }}
                                        </td>
                                        <td>
                                            {{ $receiptDetail->quantity }}
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                            <div class="mx-3 mt-3">
                                <p class="badge badge-warning" style="font-size: medium">Tổng tiền: {{ CurrencyHelper::format($total) }}</p>
                                <p class="badge badge-warning" style="font-size: medium">Tổng SL: {{ $sum }}</p>
                            </div>
                        @else
                            <div class="text-center mt-3 mb-3">
                                <strong>Không có dữ liệu nào được thêm vào</strong>
                            </div>
                        @endif

                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
