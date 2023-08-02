@extends('admin.layouts.app')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
    <style>
        .form-file-group{
            width: 82%;
            border: 2px dashed #000;
        }
        .form-file-group p {
            width: 100%;
            text-align: center;
            line-height: 170px;
        }
    </style>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Cập nhật sản phẩm</h4>
            <div class="basic-form">
                <form action="{{ route('product.update', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <div class="form-group">
                        <label class="col-sm-2 col-form-label">Tên sản phẩm</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value="{{ $product->name }}" placeholder="Nhập tên sản phâm">
                            @error('name')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 col-form-label">Danh mục</label>
                        <div class="col-sm-10 form-group">
                            <select class="form-control" name="category_id" >
                                <option >Select a Category</option>
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
                        <label class="col-sm-2 col-form-label">Mã sản phẩm</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="sku" value="{{ $product->sku }}" placeholder="Nhập Mã sản phẩm">
                            @error('sku')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 col-form-label">Số lượng</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="stock" value="{{ $product->stock }}" placeholder="Nhập số lượng	">
                            @error('stock')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 col-form-label">Mô tả</label>
                        <div class="col-sm-10">
                            <textarea type="text" class="form-control" id="editor" name="description" placeholder="Nhập mô tả">{{ $product->description }}</textarea>
                            @error('description')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 col-form-label">Giá Gốc</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="original_price" value="{{ $product->original_price }}" placeholder="Nhập giá góc">
                            @error('original_price')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 col-form-label">Giá Bán</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="selling_price" value="{{ $product->selling_price }}" placeholder="Nhập giá bán">
                            @error('selling_price')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 col-form-label">Hình ảnh:</label>
                        <div class="col-sm-10">
                            <img src="{{( 'storage/'.$product->image) }}" alt="{{ $product->name }}"
                                 class="img-fluid">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="mb-3">
                            <label for="editor" class="form-label">Chọn ảnh thay thế: </label>
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

                    <div class="form-group">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-dark">Cập nhật</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    <script>
        CKEDITOR.replace( 'editor' );

        function previewFile(input){
            let file = $("input[type=file]").get(0).files[0];
            if(file){
                let reader = new FileReader();
                reader.onload = function (){
                    $("#previewImg").attr('src', reader.result);
                    $("#previewBox").css('display', 'block');
                }
                $(".form-file-group").css('display', 'none');
                reader.readAsDataURL(file);
            }
        }
        function removePreview(){
            $("#previewImg").attr('src',"");
            $("#previewBox").css('display', 'none');
            $(".form-file-group").css('display', 'block');
        }
    </script>
@endsection
