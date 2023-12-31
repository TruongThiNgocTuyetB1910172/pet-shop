@extends('admin.layouts.app')

@section('title', 'Thêm mới banner')

@section('content')
<div class="my-3">
    <section class="content">
        <div class="container-fluid">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Thêm danh banner mới</h3>
                </div>
                <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <label class="form-label"> <strong>Trạng thái:</strong></label>
                        <div class="d-flex">
                            <div class="justify-content-center align-content-center">
                                <input type="radio" id="is_active" name="status" value="1">
                                <label for="is_active">Hiện</label><br></div>
                            <div class="justify-content-center align-content-center ml-5">
                                <input type="radio" id="is_block" name="status" value="0">
                                <label for="is_block">Ẩn</label><br>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="editor" class="form-label"> <strong>Chọn ảnh: </strong></label>
                                <div class="form-file-group">
                                    <input type="file" name="image" style="display: none;" id="file-upload"
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
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Thêm mới</button>
                            </div>
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
