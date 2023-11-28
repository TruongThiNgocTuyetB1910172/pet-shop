@extends('admin.layouts.app')

@section('title','Cập nhật sản phẩm')

@section('content')

    <div class="my-3">
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Thêm sản phẩm mới</h3>
                    </div>
                    <form action="{{ route('product.update', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label class="form-label"><strong>Tên sản phẩm: </strong></label>
                                    <div >
                                        <input type="text" class="form-control" name="name" value="{{ $product->name }}" placeholder="Nhập tên sản phâm">
                                        @error('name')
                                        <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-6">
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
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label class="form-label"><strong>Mã sản phẩm: </strong></label>
                                    <div >
                                        <input type="text" class="form-control" name="sku" value="{{ $product->sku }}" placeholder="Nhập Mã sản phẩm">
                                        @error('sku')
                                        <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-6">
                                    <label class="form-label"><strong>Giá Bán:</strong></label>
                                    <div >
                                        <input type="text" class="form-control" name="selling_price" value="{{ $product->selling_price }}" placeholder="Nhập giá bán">
                                        @error('selling_price')
                                        <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
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
                                <label class="form-label"><strong>Hình ảnh: </strong></label>
                                <div class="col-sm-10">
                                    <img src="{{( 'storage/'.$product->image) }}" alt="{{ $product->name }}"
                                         class="img-fluid" width="100px", height="100px">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editor" class="form-label"><strong>Chọn ảnh thay thế: </strong></label>
                                <div class="form-file-group">
                                    <input type="file" name="image" style="display: none;" id="file-upload" onchange="previewFile(this)">
                                    <p onclick="document.querySelector('#file-upload').click()"><i class="fa fa-file-image-o" aria-hidden="true"></i>
                                        Nhấn vào đây để chọn ảnh tải lên.
                                    </p>
                                </div>
                                <div id="previewBox" style="display: none" class="text-center">
                                    <img src="" id="previewImg" class="img-fluid rounded" width="100px" height="100px">
                                    <i class="uil-trash-alt text-danger" style="cursor: pointer" onclick="removePreview()">Xóa ảnh</i>
                                </div>

                                @error('image')
                                <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="editor" class="form-label"><strong>Ảnh phụ: </strong></label>
                                <div class="mt-6">
                                    @foreach($product->productImages as $image)
                                       <div class="row">
                                           <div class="d-flex justify-content-between mx-4">
                                            <div>
                                                <img src="{{ $image->image }}" height="100px" width="100px" alt="photo">
                                                <span onclick="return confirm('Are you sure?')"><a href="{{ route('product.delete-image', ['id' => $image->id]) }}" style="color: red">Xóa</a></span>
                                            </div>
                                           </div>
                                           @endforeach
                                       </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editor" class="form-label"><strong>Chọn ảnh phụ thay thế: </strong></label>
                                <div class="mb-3">
                                    <input type="file" name="product_image[]" multiple>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <style>
        #container {
            width: 1000px;
            margin: 20px auto;
        }
        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 200px;
        }
        .ck-content .image {
            /* block images */
            max-width: 80%;
            margin: 20px auto;
        }
    </style>

@endsection
@section('footer')
    <script>
        function previewFile(input) {
            let file = input.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function() {
                    $("#previewImg").attr('src', reader.result);
                    $("#previewBox").css('display', 'block');
                }
                $(".form-file-group").css('display', 'none');
                reader.readAsDataURL(file);
            }
        }

        function removePreview() {
            $("#previewImg").attr('src', "");
            $("#previewBox").css('display', 'none');
            $(".form-file-group").css('display', 'block');
        }
    </script>
    </script>
@endsection
@section('styles')
    <style>
        .form-file-group{
            border: 2px dashed #000;
            border-radius: .25rem;
        }
        .form-file-group p {
            width: 100%;
            text-align: center;
            line-height: 170px;
        }
    </style>
@endsection
