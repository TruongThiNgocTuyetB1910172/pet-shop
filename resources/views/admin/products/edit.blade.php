@extends('admin.layouts.app')

@section('title','Cập nhật sản phẩm')

@section('content')
    <div>  <h4 class="card-title text-uppercase">Cập nhật sản phẩm: {{ $product->name }}</h4></div>
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
                <form action="{{ route('product.update', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label class="form-label"><strong>Tên sản phẩm: </strong></label>
                        <div >
                            <input type="text" class="form-control" name="name" value="{{ $product->name }}" placeholder="Nhập tên sản phâm">
                            @error('name')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label"> <strong>Danh mục:</strong></label>
                        <div class="form-group">
                            <select class="form-control" name="category_id" >
                                <option >Chọn danh mục</option>
                                @foreach ($categories as $category )
                                    <option value="{{ $category->id }}" {{ $product->category->id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
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
                            <input type="text" class="form-control" name="sku" value="{{ $product->sku }}" placeholder="Nhập Mã sản phẩm">
                            @error('sku')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><strong>Số lượng</strong></label>
                        <div >
                            <input type="text" class="form-control" name="stock" value="{{ $product->stock }}" placeholder="Nhập số lượng	">
                            @error('stock')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><strong>Mô tả: </strong></label>
                        <div >
                            <textarea type="text" class="form-control" id="editor" name="description" placeholder="Nhập mô tả">{{ $product->description }}</textarea>
                            @error('description')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label"> <strong>Nỗi bật: </strong></label>
                        <div class="d-flex">
                            <div class="justify-content-center align-content-center">
                                <input type="radio" id="is_active" name="feature" value="1" @if($product->feature == 1) checked @endif>
                                <label for="is_active">SP nỗi bật</label><br></div>
                            <div class="justify-content-center align-content-center ml-5">
                                <input type="radio" id="is_block" name="feature" value="0" @if($product->feature == 0) checked @endif>
                                <label for="is_block">SP thường</label><br>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><strong>Giá Gốc:</strong></label>
                        <div >
                            <input type="text" class="form-control" name="original_price" value="{{ $product->original_price }}" placeholder="Nhập giá góc">
                            @error('original_price')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><strong>Giá Bán:</strong></label>
                        <div >
                            <input type="text" class="form-control" name="selling_price" value="{{ $product->selling_price }}" placeholder="Nhập giá bán">
                            @error('selling_price')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><strong>Hình ảnh:</strong></label>
                        <div >
                            <img src="{{( 'storage/'.$product->image) }}" alt="{{ $product->name }}" height="100px" width="100px"
                                 class="img-fluid">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="mb-3">
                            <label for="editor" class="form-label"><strong>Chọn ảnh thay thế: </strong></label>
                            <div class=" form-file-group">
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

                    <div class="form-group">
                        <label for="editor" class="form-label"><strong>Ảnh phụ: </strong></label>
                        <div class="mt-6">
                            @foreach($product->productImages as $image)
                                <div class="mt-6">
                                    <img src="{{ $image->image }}" height="100px" width="100px" alt="photo">

                                    <span onclick="return confirm('Are you sure?')"><a href="{{ route('product.delete-image', ['id' => $image->id]) }}">Xóa</a></span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editor" class="form-label"><strong>Chọn ảnh phụ thay thế: </strong></label>
                        <div class="mb-3">
                            <input type="file" name="product_image[]" multiple>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                            <button type="submit" class="btn btn-dark">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

