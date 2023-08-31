<div>
    <section class="boxed-sm">
        <div class="container">
            <div class="woocommerce">
                <div class="row ">

                    <form  wire:submit.prevent="addNew" method="POST"   class="woocommerce-checkout col-md-12 ">

                        <h4 style="margin-bottom: 20px">Thông tin giao hàng</h4>
                        <div class="row">
                            <div class="col-md-6">
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
                            <div class="col-md-3">
                                <label>Số điện thoại<span style="color: red">*</span></label>
                                <input type="text" name="phoneNumber" class="form-control"  wire:model="phoneNumber">

                                @error('phoneNumber')
                                <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
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
                            <div class="col-md-3">
                                <label>Số nhà/ Ấp<span style="color: red">*</span></label>
                                <input type="text" name="houseNumber" class="form-control" wire:model="houseNumber">
                                @error('houseNumber')
                                <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
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
                            <div class="col-md-3">
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
                            <div class="col-md-3">
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
