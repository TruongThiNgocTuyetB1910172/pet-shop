@extends('admin.layouts.app')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Admin Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{( 'storage/'.$admin->image) }}" alt="{{ $admin->name}}"
                                >
                            </div>

                            <h3 class="profile-username text-center">{{ $admin->name }}</h3>

                            <p class="text-muted text-center">{{ $admin->email }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Giới tính</b>
                                    @if($admin->gender === 1)
                                        <a class="float-right">Nam</a>
                                    @else
                                        <a class="float-right">Nữ</a>
                                    @endif
                                </li>
                                <li class="list-group-item">
                                    <b>Số điện thoại</b> <a class="float-right">{{ $admin->phone }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Chức vụ</b>
                                    @if($admin->role == 'admin')
                                        <a class="float-right">Quản trị viên</a>
                                    @elseif($admin->role == 'employee')
                                        <a class="float-right">Nhân viên nhập kho</a>
                                    @elseif($admin->role == 'orderChecker')
                                        <a class="float-right">Nhân viên duyệt đơn</a>
                                    @endif
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('admin-profile.update', ['id' => $admin->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Tên</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputName" value="{{ $admin->name }}" name="name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName2" class="col-sm-2 col-form-label">Số điện thoại</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="inputName2" value="{{ $admin->phone}}" name="phone">
                                    </div>
                                </div>
                                <div class="form-group row" >
                                    <div class="col-sm-2 ">
                                        <strong>Email </strong>
                                    </div>
                                    <div class="form-group col-sm-10">
                                        <p class="form-control" >{{ $admin->email }}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><strong>Giới tính:</strong></label>
                                    <div class="d-flex">
                                        <div class="justify-content-center align-content-center">
                                            <input type="radio" name="gender" value="1" @if($admin->gender == 1) checked @endif>
                                            <label>Nam</label><br></div>
                                        <div class="justify-content-center align-content-center ml-5">
                                            <input type="radio" name="gender" value="0" @if($admin->gender == 0) checked @endif>
                                            <label>Nữ</label><br>
                                        </div>
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
                                    <button type="submit" class="btn btn-primary">Thay đổi</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h3>Thay đổi mật khẩu</h3>
                            <form class="form-horizontal" action="{{ route('admin-password.update', ['id' => $admin->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-3 col-form-label">Mật khẩu hiện tại:</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="inputName" name="password_old">
                                        @error('password_old')
                                        <span class="text-danger" role="alert">
                                     <strong>{{ $message }}</strong>
                                </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName2" class="col-sm-3 col-form-label">Mật khẩu mới:</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="inputName2" name="password">
                                        @error('password')
                                        <span class="text-danger" role="alert">
                                     <strong>{{ $message }}</strong>
                                </span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName2" class="col-sm-3 col-form-label">Nhập lại mật khẩu mới:</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="inputName2" name="new_password_confirmation">
                                        @error('new_password_confirmation')
                                        <span class="text-danger" role="alert">
                                     <strong>{{ $message }}</strong>
                                </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Thay đổi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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

