@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Sản phẩm mới</h4>
            <div class="basic-form">
                <form>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tên sản phẩm</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="name" placeholder="Nhập tên sản phâm">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Danh mục</label>
                        <select class="select-form" name="category_id" >
                            <option value="">Select a Category</option>
                            @foreach ($categories as $item )
                                <option value="{{ $item->id }}">{{ $item->name }}</option>

                            @endforeach

                        </select>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Mã sản phẩm</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="sku" placeholder="Nhập Mã sản phẩm	">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Số lượng</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="stock" placeholder="Nhập số lượng	">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Mô tả</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="description" placeholder="Nhập mô tả	">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Giá Góc</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="original_price" placeholder="Nhập giá góc">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Giá Bán</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="selling_price" placeholder="Nhập giá bán">
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Hình ảnh </h4>
                        <div class="basic-form">
                            <form>
                                <div class="form-group">
                                    <input type="file" class="form-control-file" name="image">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-dark">Tạo</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

@endsection
