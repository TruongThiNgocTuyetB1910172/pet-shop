@extends('admin.layouts.app')

@section('title','edit phiếu nhập ')

@section('content')
    <div class="my-3">
        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('receipt.update', ['id' => $receipt->id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách sản phẩm nhập</h3>
                        </div>
                        @csrf

                        <div class="card-body table-responsive p-0">
                            <table class="table table-head-fixed text-nowrap">
                                @php $total = 0;
                                @endphp
                                <thead>
                                <tr>
                                    <td>Id</td>
                                    <td></td>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá nhập</th>
                                    <th>Số lượng</th>
                                    <th>Tong</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($receiptDetails->count() > 0)
                                    @foreach($receiptDetails as $receiptDetail)
                                        @php
                                            $total =$receiptDetail->quantity * $receiptDetail->price;
                                        @endphp
                                        <tr>
                                            <td>{{ $receiptDetail->id }}</td>
                                            <td><img src="{{ asset('storage/' . $receiptDetail->product->image) }}" alt="{{ $receiptDetail->product->name }}"
                                                     width="50px" height="50px"></td>
                                            <td>{{ $receiptDetail->product->name }}</td>
                                            <td>
                                                <div >
                                                    <input type="text" class="form-control" name="price[]" placeholder="Nhập giá bán" value="{{ $receiptDetail->price }}">
                                                    @error('price')
                                                    <span class="text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </td>
                                            <td>
                                                <div >
                                                    <input type="text" class="form-control" name="quantity[]" placeholder="Nhập số lượng" value="{{ $receiptDetail->quantity }}">
                                                    @error('quantity')
                                                    <span class="text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </td>
                                            <td>
                                                {{ CurrencyHelper::format($total) }}
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
                            <div class="mb-3 mx-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Chú thích</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="notes">{{ $receipt->notes }}</textarea>
                            </div>
                            <div class="form-group">
                                <div class="text-uppercase text-center"><h4>Xác nhận</h4></div>
                                <hr>
                                <p class="form-label text-center"> <strong>Trạng thái của đơn hàng: </strong></p>
                                <div>
                                    <select class="form-control text-center " name="status" style="border: none">
                                        <option>Chọn trạng thái đơn hàng</option>
                                        <option value="pending"  {{ $receipt->status ==  'pending' ? 'selected' : ''}}>Đang chờ duyệt</option>
                                        <option value="accepted" {{ $receipt->status ==  'accepted' ? 'selected' : ''}}>Đã được duyệt</option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-primary mx-3 mt-3 mb-3" type="submit">Cập nhật </button>
                        </div>

                    </div>

                </form>
            </div>
        </section>
    </div>
@endsection
