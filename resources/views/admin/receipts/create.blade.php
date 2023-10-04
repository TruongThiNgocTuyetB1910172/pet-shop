@extends('admin.layouts.app')

@section('title','Thêm mới phiếu nhập')

@section('content')
    <div class="my-3">
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Thêm phiếu nhập mới</h3>
                    </div>
                    <form action="{{ route('receipt.add-product-item-to-receipt') }}" method="POST">
                        @csrf
                        <div class="card-body table-responsive p-0">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label for="editor" class="form-label"><strong>Chọn các sản phẩm: </strong></label>
                                            @foreach($products as $product)
                                                <div class="form-check mt-3 ">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" value="{{ $product->id }}" name="options[]">
                                                        {{ $product->name }})

                                                        @error('product_ids')
                                                        <span class="text-danger"> {{ $message }}</span>
                                                        @enderror
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group mx-4">
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

@endsection




{{--@extends('admin.layouts.app')--}}

{{--@section('title','Thêm mới phiếu nhập')--}}

{{--@section('content')--}}
{{--    <div class="my-3">--}}
{{--        <section class="content">--}}
{{--            <div class="container-fluid">--}}
{{--                <div class="card card-primary">--}}
{{--                    <div class="card-header">--}}
{{--                        <h3 class="card-title">Thêm phiếu nhập mới</h3>--}}
{{--                    </div>--}}
{{--                    <form action="{{ route('receipt.add-product-item-to-receipt') }}" method="POST">--}}
{{--                        @csrf--}}
{{--                        <div class="card-body table-responsive p-0">--}}
{{--                            <table class="table table-head-fixed text-nowrap">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>Tên sản phẩm</th>--}}
{{--                                    <th>Giá</th>--}}
{{--                                    <th>Số lượng</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                <tr>--}}
{{--                                    <td>--}}
{{--                                        <div class="form-group col-6">--}}
{{--                                            <label class="form-label"> <strong>Danh mục:</strong></label>--}}
{{--                                            <div class="form-group">--}}
{{--                                                <select class="form-control" name="options[]" >--}}
{{--                                                    <option >Chọn danh mục</option>--}}
{{--                                                    @foreach ($products as $product )--}}
{{--                                                        <option value="{{ $product->id }}" >{{ $product->name }}</option>--}}
{{--                                                    @endforeach--}}
{{--                                                </select>--}}
{{--                                                @error('product_ids')--}}
{{--                                                <span class="text-danger"> {{ $message }}</span>--}}
{{--                                                @enderror--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <div class="form-group col-6">--}}
{{--                                            <label class="form-label" ><strong>Giá Nhập: </strong></label>--}}
{{--                                            <div >--}}
{{--                                                <input type="number" class="form-control" name="price[]" placeholder="Nhập giá ">--}}
{{--                                                @error('price')--}}
{{--                                                <span class="text-danger"> {{ $message }}</span>--}}
{{--                                                @enderror--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <div class="form-group col-6">--}}
{{--                                            <label class="form-label"><strong>Số lượng: </strong></label>--}}
{{--                                            <div>--}}
{{--                                                <input type="number" class="form-control" name="quantity[]" placeholder="Nhập số lượng	">--}}
{{--                                                @error('quantity')--}}
{{--                                                <span class="text-danger"> {{ $message }}</span>--}}
{{--                                                @enderror--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                        <div class="form-group mx-4">--}}
{{--                            <button type="submit" class="btn btn-primary">Thêm mới</button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
{{--    </div>--}}

{{--@endsection--}}

