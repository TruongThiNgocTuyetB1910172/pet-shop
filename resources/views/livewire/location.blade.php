<div>
    <section class="boxed-sm">
        <div class="container">
            <div class="woocommerce">
                <div class="row">
                    <div class="col-md-6">
                        <form  method="POST" enctype="multipart/form-data">
                            @foreach($users as $user)
                                <div class="row ">
                                    <div>
                                        <div class="text-uppercase text-center"  >
                                            <h4><strong>Thông tin cá nhân</strong></h4>
                                            <hr style="height:1px;border-width:0;color:gray;background-color:gray">
                                        </div>
                                        <div class="form-group">
                                            <div style="text-align: center">
                                                <img src="{{ asset('storage/'.$user->image) }}" alt="{{ $user->name }}"
                                                     class="img-fluid" width="140px", height="140px" style="border-radius: 50%">
                                            </div>
                                        </div>
                                        <div >
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <i class="fa fa-address-book" aria-hidden="true"></i>
                                                    <strong>Tên khách hàng: </strong>
                                                </div>
                                                <div class="form-group col-md-8">
                                                    <p class="form-control">{{ $user->name }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 ">
                                                    <i class="fa fa-phone-square" aria-hidden="true"></i>
                                                    <strong>Số điện thoại: </strong>
                                                </div>
                                                <div class="form-group col-md-8">
                                                    <p class="form-control">{{ $user->phone }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 ">
                                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                                    <strong>Địa chỉ email: </strong>
                                                </div>
                                                <div class="form-group col-md-8">
                                                    <p class="form-control">{{ $user->email }}</p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <i class="fa fa-transgender" aria-hidden="true"></i>
                                                        <label class="form-label"><strong>Giới tính:</strong></label>
                                                    </div>
                                                    <div  class="form-group col-md-8">
                                                            <p class="form-control">{{ $user->gender == 1 ? 'Nam' : 'Nữ' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div>
                                <a href="{{ route('profile.edit', ['id' => $user->id]) }}" type="submit" class="btn btn-primary">Thay đổi</a>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <form  wire:submit.prevent="addNew" method="POST" class="woocommerce-checkout ">
                            <div class="text-uppercase text-center" >
                                <h4><strong>Địa chỉ giao hàng</strong></h4>
                                <hr style="height:1px;border-width:0;color:gray;background-color:gray">
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Tên người nhận <span style="color: red">*</span></label>
                                    <input type="text" name="userName" class="form-control" wire:model="userName">
                                    @error('userName')
                                    <span class="text-danger" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                    @enderror
                                </div>
                            </div>
                            <div  class="row">
                                <div class="col-md-6">
                                    <label>Số điện thoại<span style="color: red">*</span></label>
                                    <input type="text" name="phoneNumber" class="form-control"  wire:model="phoneNumber">

                                    @error('phoneNumber')
                                    <span class="text-danger" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>Email: </label>
                                    <input type="email" name="email" class="form-control" wire:model="email" >
                                    @error('email')
                                    <span class="text-danger" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Số nhà/ Ấp<span style="color: red">*</span></label>
                                    <input type="text" name="houseNumber" class="form-control" wire:model="houseNumber">
                                    @error('houseNumber')
                                    <span class="text-danger" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>Tỉnh <span style="color: red">*</span></label>
                                    <select  wire:model.live="provinceId" class="form-control" id="province" name="provinceId">
                                        @foreach($provinces as $province)
                                            <option value="{{$province->id}}">{{$province->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('provinceId')
                                    <span class="text-danger" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Huyện<span style="color: red">*</span></label>
                                    <select wire:model.live="districtId" class="form-control" id="district" name="districtId">
                                        @foreach($districts as $district)
                                            <option value="{{$district->id}}">{{$district->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('districtId')
                                    <span class="text-danger" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>Xã <span style="color: red">*</span></label>
                                    <select wire:model.live="wardId" class="form-control" id="ward" name="wardId">
                                        @foreach($wards as $ward)
                                            <option value="{{$ward->id}}">{{$ward->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('wardId')
                                    <span class="text-danger" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <div class="woocommerce-info">
                                @foreach($addresses as $address)
                                    <div class="row">
                                        <div class="col-md-11">
                                            <span>{{ $address->user_name }}, {{ $address->phone_number }}, {{ $address->house_number }}, {{ $address->ward->name }}, {{ $address->district->name }}, {{ $address->province->name }} </span>
                                        </div>
                                        <div class="col-md-1">
                                            <a href="{{ route('address.delete', ['id' => $address->id]) }}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group ">
                                <button type="submit" class="btn btn-primary">Thêm mới</button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

@section('footer')
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
@endsection

