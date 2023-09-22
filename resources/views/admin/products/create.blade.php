@extends('admin.layouts.app')

@section('title','Thêm mới sản phẩm')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Thêm sản phẩm mới</h3>
            </div>
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                   <div class="row">
                       <div class="form-group col-6">
                           <label class="form-label"><strong>Tên sản phẩm:</strong></label>
                           <div>
                               <input type="text " class="form-control" name="name" placeholder="Nhập tên sản phâm">
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
                                       <option value="{{ $category->id }}" >{{ $category->name }}</option>
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
                                <input type="number" class="form-control" name="sku" placeholder="Nhập Mã sản phẩm	">
                                @error('sku')
                                <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label class="form-label"><strong>Số lượng: </strong></label>
                            <div>
                                <input type="number" class="form-control" name="stock" placeholder="Nhập số lượng	">
                                @error('stock')
                                <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label class="form-label"><strong>Giá Gốc: </strong></label>
                            <div >
                                <input type="text" class="form-control" name="original_price" placeholder="Nhập giá góc">
                                @error('original_price')
                                <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label class="form-label" ><strong>Giá Bán: </strong></label>
                            <div >
                                <input type="text" class="form-control" name="selling_price" placeholder="Nhập giá bán">
                                @error('selling_price')
                                <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
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
                        <label class="form-label"> <strong>Nổi bật:</strong></label>
                        <div class="d-flex">
                            <div class="justify-content-center align-content-center">
                                <input type="radio" name="feature" value="1">
                                <label for="is_active">Sp nổi bật</label><br></div>
                            <div class="justify-content-center align-content-center ml-5">
                                <input type="radio" name="feature" value="0">
                                <label for="is_block">Sp thường</label><br>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="mb-3">
                            <label for="editor" class="form-label"><strong>Chọn ảnh:</strong> </label>
                            <div class="form-file-group">
                                <input type="file" name="image" style="display: none" id="file-upload"
                                       onchange="previewFile(this)">
                                <p onclick="document.querySelector('#file-upload').click()"><i class="fa fa-file-image-o" aria-hidden="true"></i>
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

                    <div class="mb-3">
                        <input type="file" name="product_image[]" multiple>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                </div>
            </form>
        </div>
    </div>
</section>

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

