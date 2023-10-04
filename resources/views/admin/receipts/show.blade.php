@extends('admin.layouts.app')

@section('title','Danh sách phiếu nhập ')

@section('content')
    <div class="my-3">
        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('receipt.add-price-and-quantity') }}" method="POST">
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
                                </tr>
                                </thead>
                                <tbody>
                                @if($products->count() > 0)
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td><img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                                     width="50px" height="50px"></td>
                                            <td>{{ $product->name }}</td>
                                            <td>
                                                <div >
                                                    <input type="text" class="form-control" name="price[]" placeholder="Nhập giá bán">
                                                    @error('price')
                                                    <span class="text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </td>
                                            <td>
                                                <div >
                                                    <input type="text" class="form-control" name="quantity[]" placeholder="Nhập số lượng">
                                                    @error('quantity')
                                                    <span class="text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
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
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="notes"></textarea>
                            </div>

                            <button class="btn btn-primary mx-3 mt-3 mb-3" type="submit"> Lưu </button>
                        </div>

                    </div>

                </form>
            </div>
        </section>
    </div>
@endsection
