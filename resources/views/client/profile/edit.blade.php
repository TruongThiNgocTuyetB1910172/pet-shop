
@extends('client.layouts.app')
@section('content')

    <section class="boxed-sm">
        <div class="container">
            <div class="woocommerce">
               <div class="row">
                   <div class="col-md-6">
                       <form  method="POST" class="woocommerce-checkout" action="{{ route('profile.update',['id'=> $user->id]) }}" enctype="multipart/form-data">
                           @method('PUT')
                           @csrf
                           <div class="text-uppercase text-center" >
                               <h4><strong>Cập nhật thông tin cá nhân</strong></h4>
                               <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                           </div>

                               <div class="">
                                   <label>Tên khách hàng: <span style="color: red">*</span></label>
                                   <input type="text" name="name" class="form-control" value="{{ $user->name }}" >
                                   @error('name')
                                   <span class="text-danger" role="alert">
                                     <strong>{{ $message }}</strong>
                                </span>
                                   @enderror
                               </div>


                               <div>
                                   <label> Số điện thoại: <span style="color: red">*</span></label>
                                   <input type="text" name="phone" class="form-control" value="{{ $user->phone }}" >
                                   @error('phone')
                                   <span class="text-danger" role="alert">
                                     <strong>{{ $message }}</strong>
                                </span>
                                   @enderror
                               </div>


                               <div>
                                   <label>Địa chỉ email: <span style="color: red">*</span></label>
                                   <p name="email" class="form-control"  >{{ $user->email }}</p>
                                   @error('email')
                                   <span class="text-danger" role="alert">
                                     <strong>{{ $message }}</strong>
                                </span>
                                   @enderror
                               </div>

                           <div class="form-group">
                               <div class="row" >
                                   <div class="col-md-4 ">
                                       <label class="form-label"><strong>Giới tính:</strong></label>
                                   </div>
                                   <div  class="form-group col-md-8">
                                       <input type="radio" name="gender" value="1" @if($user->gender == 1) checked @endif>
                                       <label >Nam</label>

                                       <input type="radio" name="gender" value="0"  @if($user->gender == 0) checked @endif>
                                       <label >Nữ</label>
                                   </div>
                               </div>
                           </div>
                           <div class="form-group">
                               <div class="col-sm-10">
                                   <img src="{{ asset('storage/'.$user->image) }}" alt="{{ $user->name }}"
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
                           <div style="margin-bottom: 30px">
                               <button type="submit" class="btn btn-success">Lưu thay đổi</button>
                           </div>
                       </form>
                   </div>
                   <div class="col-md-6">
                       <form  method="POST" class="woocommerce-checkout" action="{{ route('profile.update-password',['id'=> $user->id]) }}" enctype="multipart/form-data">
                           @method('PUT')
                           @csrf
                           <div class="text-uppercase text-center" >
                               <h4><strong>Cập nhật mật khẩu</strong></h4>
                               <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                           </div>
                           <div>
                               <label>Mật khẩu hiện tại: <span style="color: red">*</span></label>
                               <input type="password" name="password_old" id="password_old" class="form-control"  >
                               @error('password_old')
                               <span class="text-danger" role="alert">
                                     <strong>{{ $message }}</strong>
                                </span>
                               @enderror
                           </div>
                           <div>
                               <label>Mật khẩu mới: <span style="color: red">*</span></label>
                               <input type="password" name="password"  id="password" class="form-control"  >
                               @error('password')
                               <span class="text-danger" role="alert">
                                     <strong>{{ $message }}</strong>
                                </span>
                               @enderror
                           </div>
                           <div>
                               <label>Nhập lại mật khẩu mới: <span style="color: red">*</span></label>
                               <input type="password" name="new_password_confirmation"  id="password" class="form-control"  >
                               @error('new_password_confirmation')
                               <span class="text-danger" role="alert">
                                     <strong>{{ $message }}</strong>
                                </span>
                               @enderror
                           </div>
{{--                           <div>--}}
{{--                               <label>Nhập lại mật khẩu: <span style="color: red">*</span></label>--}}
{{--                               <input type="password" name="password_confirm" class="form-control"  >--}}
{{--                               @error('password_confirm')--}}
{{--                               <span class="text-danger" role="alert">--}}
{{--                                     <strong>{{ $message }}</strong>--}}
{{--                                </span>--}}
{{--                               @enderror--}}
{{--                           </div>--}}
                           <div style="margin-bottom: 30px; margin-top: 30px">
                               <button type="submit" class="btn btn-success">Lưu thay đổi</button>
                           </div>
                       </form>
                   </div>
               </div>
            </div>
        </div>
    </section>

@endsection

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
