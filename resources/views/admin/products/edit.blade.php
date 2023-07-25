@extends('admin.layouts.app')
@section('content')
    <form action="{{ route('product.update', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Sản phẩm mới</h4>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tên sản phẩm:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value="{{ $product->name }}" placeholder="Nhập tên sản phẩm">
                        @error('name')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Danh mục:</label>
                    <div class="col-sm-10">
                        <select class="select-form" name="category_id"  value="{{ $product->category_id }}">
                            <option value="">Select a Category</option>

                            @foreach ($categories as $category )
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('category_id')
                    <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Mã sản phẩm:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="sku" value="{{ $product->sku }}" placeholder="Nhập mã">
                        @error('sku')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Số lượng:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="stock" value="{{ $product->stock }}" placeholder="Nhập số lượng	">
                        @error('stock')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Mô tả:</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" name="description"  value="{{ $product->description }}" placeholder="Nhập mô tả"></textarea>
                        @error('description')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Giá Gốc:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="original_price" value="{{ $product->original_price }}" placeholder="Nhập giá gốc">
                        @error('original_price')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Giá Bán:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="selling_price" value="{{ $product->selling_price }}" placeholder="Nhập giá bán">
                        @error('selling_price')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Hình ảnh:</label>
                    <div class="col-sm-10">
                        <input type="file" accept="image/*" class="form-control" name="image" >

                        @error('image')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nhiều ảnh hơn:</label>
                    <div class="col-sm-10">
                        <input type="file" accept="image/*" class="form-control" name="product_image[]" multiple>

                        @error('product_image.*')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-dark mb-2">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
