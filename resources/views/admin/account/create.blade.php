@extends('admin.layouts.app')

@section('title','Thêm tài khoản mới')

@section('content')
 <div class="my-3">
     <section class="content">
         <div class="container-fluid">
             <!-- general form elements -->
             <div class="card card-primary">
                 <div class="card-header">
                     <h3 class="card-title">Thêm tài khoản mới</h3>
                 </div>
                 <form action="{{ route('account.store') }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="card-body">
                         <div class="row">
                             <div class="form-group col-6">
                                 <label class="form-label"><strong>Tên tài khoản:</strong></label>
                                 <div>
                                     <input type="text" class="form-control" name="name" placeholder="Nhập tên tài khoản">
                                     @error('name')
                                     <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                     @enderror
                                 </div>
                             </div>
                             <div class="form-group col-6">
                                 <label class="form-label"><strong>Số điện thoại:</strong></label>
                                 <div>
                                     <input type="number" class="form-control" name="phone" placeholder="Nhập số điện thoại">
                                     @error('phone')
                                     <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                     @enderror
                                 </div>
                             </div>
                         </div>

                         <div class="row">
                             <div class="form-group col-6">
                                 <label class="form-label"><strong>Email:</strong></label>
                                 <div>
                                     <input type="email" class="form-control" name="email" placeholder="Nhập email">
                                     @error('email')
                                     <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                     @enderror
                                 </div>
                             </div>

                             <div class="form-group col-6">
                                 <label class="form-label"><strong>Mật khẩu:</strong></label>
                                 <div>
                                     <input type="password" class="form-control" name="password" placeholder="Mật khẩu" id="pwd">
                                     <p style="cursor: pointer" id="showHidePassword" onclick="showHidePassword()" class="mt-2">Show password</p>
                                     @error('password')
                                     <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                     @enderror
                                 </div>
                             </div>
                         </div>

                         <div class="form-group">
                             <label class="form-label"><strong>Giới tính:</strong></label>
                             <div class="d-flex">
                                 <div class="justify-content-center align-content-center">
                                     <input type="radio" name="gender" value="1">
                                     <label >Nam</label><br></div>
                                 <div class="justify-content-center align-content-center ml-5">
                                     <input type="radio" name="gender" value="0">
                                     <label >Nữ</label><br>
                                 </div>
                             </div>
                         </div>

                         <div class="form-group col-6">
                             <label class="form-label"><strong>Quyền:</strong></label>
                             <select class="form-control text-center " name="role" style="border: none">
                                 <option>Chọn quyền</option>
                                 <option value="admin">Người quản trị</option>
                                 <option value="employee">Nhân viên nhập kho</option>
                                 <option value="orderChecker" >Nhân viên duyệt đơn hàng</option>
                             </select>
                         </div>

                         <div class="form-group">
                             <label class="form-label"><strong>Trạng thái:</strong></label>
                             <div class="d-flex">
                                 <div class="justify-content-center align-content-center">
                                     <input type="radio" id="is_active" name="status" value="1">
                                     <label for="is_active">Kích hoạt</label><br></div>
                                 <div class="justify-content-center align-content-center ml-5">
                                     <input type="radio" id="is_block" name="status" value="0">
                                     <label for="is_block">Block</label><br>
                                 </div>
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
                         </div>
                         <div class="form-group">
                             <button type="submit" class="btn btn-primary">Thêm mới</button>
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
        const password = document.getElementById('pwd')
        const showHidePwd = document.getElementById('showHidePassword')

        const showHidePassword = () => {
            const password = document.getElementById('pwd');
            const showHidePwd = document.getElementById('showHidePassword');

            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            showHidePwd.textContent = (type === 'password') ? 'Show password' : 'Hide password';
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
