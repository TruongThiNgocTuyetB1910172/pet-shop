@extends('admin.layouts.app')

@section('title','Thêm mới sản phẩm')

@section('content')
    <div><h4 class="card-title text-uppercase">Thêm mới sản phẩm</h4></div>
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-label"><strong>Tên sản phẩm:</strong></label>
                        <div>
                            <input type="text " class="form-control" name="name" placeholder="Nhập tên sản phâm">
                            @error('name')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-control"><strong>Danh mục: </strong></label>
                        <div >
                            <select class="select-form" name="category_id" >
                                <option value="">Select a Category</option>
                                @foreach ($categories as $category )
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>

                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><strong>Mã sản phẩm: </strong></label>
                        <div >
                            <input type="text" class="form-control" name="sku" placeholder="Nhập Mã sản phẩm	">
                            @error('sku')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><strong>Số lượng: </strong></label>
                        <div>
                            <input type="text" class="form-control" name="stock" placeholder="Nhập số lượng	">
                            @error('stock')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><strong>Mô tả: </strong></label>
                        <div >
                            <textarea type="text" class="form-control" id="editor" name="description" placeholder="Nhập mô tả"></textarea>
                            @error('description')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><strong>Giá Gốc: </strong></label>
                        <div >
                            <input type="text" class="form-control" name="original_price" placeholder="Nhập giá góc">
                            @error('original_price')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" ><strong>Giá Bán: </strong></label>
                        <div >
                            <input type="text" class="form-control" name="selling_price" placeholder="Nhập giá bán">
                            @error('selling_price')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="mb-3">
                            <label for="editor" class="form-label"><strong>Chọn ảnh:</strong> </label>
                                <div class="form-file-group">
                                    <input type="file" name="image" style="display: none" id="file-upload"
                                           onchange="previewFile(this)">
                                    <p onclick="document.querySelector('#file-upload').click()">
                                        Nhấn vào đây để chọn ảnh tải lên.
                                    </p>
                                </div>
                            <div id="previewBox" style="display: none" class="text-center">
                                <img src="" id="previewImg" class="img-fluid rounded" width="100px" height="100px">
                                <i class="uil-trash-alt text-danger" style="cursor: pointer"
                                   onclick="removePreview()">Xóa ảnh</i>
                            </div>

                            @error('image')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <input type="file" name="product_image[]" multiple>

                    <div class="form-group">
                            <button type="submit" class="btn btn-dark">Thêm mới</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

