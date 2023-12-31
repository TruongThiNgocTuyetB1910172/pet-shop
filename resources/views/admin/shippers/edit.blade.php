@extends('admin.layouts.app')

@section('title','Cập nhât tài khoản')

@section('content')
    <div class="my-3">
        <section class="content">
            <div class="container-fluid">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Cập nhật tài khoản</h3>
                    </div>
                    <form action="{{ route('shipper.update', ['id' => $shipper->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label"><strong>Tên người dùng:</strong></label>
                                <div>
                                    <input type="text" class="form-control" name="name" value="{{ $shipper->name }}" >
                                    @error('name')
                                    <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label"><strong>Email:</strong></label>
                                <div>
                                    <input type="email" class="form-control" name="email" value="{{ $shipper->email }}" readonly disabled>
                                    @error('email')
                                    <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label"><strong>Số điện thoại:</strong></label>
                                <div>
                                    <input type="number" class="form-control" name="phone" value="{{ $shipper->phone }}" >
                                    @error('phone')
                                    <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label"><strong>Giới tính:</strong></label>
                                <div class="d-flex">
                                    <div class="justify-content-center align-content-center">
                                        <input type="radio" name="gender" value="1" @if($shipper->gender == 1) checked @endif>
                                        <label>Nam</label><br></div>
                                    <div class="justify-content-center align-content-center ml-5">
                                        <input type="radio" name="gender" value="0" @if($shipper->gender == 0) checked @endif>
                                        <label>Nữ</label><br>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label"><strong>Trạng thái:</strong></label>
                                <div class="d-flex">
                                    <div class="justify-content-center align-content-center">
                                        <input type="radio"  name="status" value="1" @if($shipper->status == 1) checked @endif>
                                        <label for="is_active">Hoạt động</label><br></div>
                                    <div class="justify-content-center align-content-center ml-5">
                                        <input type="radio"  name="status" value="0" @if($shipper->status == 0) checked @endif>
                                        <label for="is_block">Chặn</label><br>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label"><strong>Hình ảnh: </strong></label>
                                <div class="col-sm-10">
                                    <img src="{{( 'storage/'.$shipper->image) }}" alt="{{ $shipper->name }}"
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
    <section class="content">
        <div class="container-fluid">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Cập nhật mật khẩu mới</h3>
                </div>
                <form action="{{ route('shipper.update-password', ['id' => $shipper->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label"><strong>Mật khẩu mới:</strong></label>
                            <div >
                                <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu mới" id="pwd">
                                <p style="cursor: pointer" id="showHidePassword" onclick="showHidePassword()" class="mt-2">Hiện mật khẩu</p>
                                @error('password')
                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </section>
@endsection
@section('footer')
    @section('footer')
        <script>
            const password = document.getElementById('pwd')
            const showHidePwd = document.getElementById('showHidePassword')

            const showHidePassword = () => {
                const password = document.getElementById('pwd');
                const showHidePwd = document.getElementById('showHidePassword');

                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                showHidePwd.textContent = (type === 'password') ? 'Hiện mật khẩu' : 'Ẩn mật khẩu';
            }
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


