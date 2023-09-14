<div>
    <section class="boxed-sm">
        <div class="container">
            <div class="woocommerce">
                <div class="row ">
                    <div class="col-md-2">
                        <p><a>Tài khoản</a></p>
                        <p><a>Mật khẩu</a></p>
                        <p><a>Lịch sử mua hàng</a></p>
                    </div>
                    <div class="col-md-4" >
                        @foreach($users as $user)
                            <div class="text-uppercase text-center"  >
                                <h4><strong>Thông tin cá nhân</strong></h4>
                                <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                            </div>
                            <div>
                                <div style=" text-align: center">
                                    <img src="https://khoinguonsangtao.vn/wp-content/uploads/2022/07/hinh-anh-anime-co-trang-1.jpg" width="100px", height="100px" style="border-radius: 50%;">
                                    <p>Ảnh đại diện</p>
                                </div>
                                <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                                <div >
                                    <label>Tên khách hàng:</label>
                                    <input value="{{ $user->name }}" class="form-control">
                                    <label >Số điện thoại:</label>
                                    <input value="{{ $user->phone }}" class="form-control">
                                    <label >Địa chỉ email:</label>
                                    <input value="{{ $user->email }}" class="form-control">
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <form  wire:submit.prevent="addNew" method="POST" class="woocommerce-checkout col-md-6 ">
                        <div class="text-uppercase text-center" >
                            <h4><strong>Địa chỉ giao hàng</strong></h4>
                            <hr style="height:2px;border-width:0;color:gray;background-color:gray">
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
                            <button type="submit" class="btn btn-success">Thêm mới</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
        <hr>
    </section>
</div>

