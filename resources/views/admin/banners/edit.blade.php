@extends('admin.layouts.app')

@section('title', 'Cập nhật banner')

@section('content')
<div class="my-3">
    <section class="content">
        <div class="container-fluid">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Cập nhật banner</h3>
                </div>
                <form action="{{ route('banner.update' ,['id' => $banner->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <label class="form-label"> <strong>Trạng thái:</strong></label>
                        <div class="d-flex">
                            <div class="justify-content-center align-content-center">
                                <input type="radio" id="is_active" name="status" value="1" @if($banner->status == 1) checked @endif>
                                <label for="is_active">Hiện</label><br></div>
                            <div class="justify-content-center align-content-center ml-5">
                                <input type="radio" id="is_block" name="status" value="0" @if($banner->status == 0) checked @endif>
                                <label for="is_block">Ẩn</label><br>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label"><strong>Hình ảnh: </strong></label>
                            <div class="col-sm-10">
                                <img src="{{( 'storage/'.$banner->image) }}" alt="{{ $banner->name }}"
                                     class="img-fluid" width="100px", height="100px">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editor" class="form-label"><strong>Chọn ảnh thay thế: </strong></label>
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
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
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
