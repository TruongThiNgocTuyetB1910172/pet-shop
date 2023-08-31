@extends('client.layouts.app')

@section('content')
    <section class="sub-header shop-detail-1">
        <img class="rellax bg-overlay" src="client/images/sub-header/015.jpg" alt="">
        <div class="overlay-call-to-action"></div>
        <h3 class="heading-style-3">New Address</h3>
    </section>
    <hr>
    <section class="boxed-sm">
        <div class="container">
            <div class="woocommerce">
                <div class="row">
                    <form  action="{{ url('new-address') }}" method="POST">
                        @csrf
                        <h4 style="margin-bottom: 20px">Thêm địa chỉ giao hàng</h4>
                        <div class="row">
                            <div class="col-md-10">
                                <label>Tên người nhận <span style="color: red">*</span></label>
                                <input type="text" name="user_name" class="form-control">
                                @error('user_name')
                                <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <label>Số điện thoại<span style="color: red">*</span></label>
                                <input type="text" name="phone_number" class="form-control"  >
                                @error('phone_number')
                                <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <label>Số nhà <span style="color: red">*</span></label>
                                <input type="text" name="house_number" class="form-control" >
                                @error('house_number')
                                <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group organic-form no-radius">
                                    <label>Email: </label>
                                    <input type="email" name="email" class="form-control" >
                                    @error('email')
                                    <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group organic-form no-radius">
                                    <label>Tỉnh <span style="color: red">*</span></label>
                                    <select class="form-control" id="province" name="province_id">
                                        <option value="">Chọn tỉnh</option>

                                        @foreach ($provinces as $province)
                                            <option value="{{$province->id}}">
                                                {{$province->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('province_id')
                                    <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group organic-form no-radius">
                                    <label>Huyện<span style="color: red">*</span></label>
                                    <select class="form-control" id="district" name="district_id">
                                    </select>
                                    @error('district_id')
                                    <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group organic-form no-radius">
                                    <label>Xã <span style="color: red">*</span></label>
                                    <select class="form-control" id="ward" name="ward_id">

                                    </select>
                                    @error('ward_id')
                                    <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Thêm mới</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <hr>
    </section>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function (){
            $('#province').change(function (){
                let province_id = $(this). val();
                $.ajax ({
                    url: 'get-district',
                    type: 'POST',
                    data: {
                        province_id: province_id,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#district').html(result)
                    },

                })
            });
            $('#district').change(function (){
                let district_id = $(this). val();

                $.ajax ({
                    url: 'get-ward',
                    type: 'POST',
                    data: {
                        district_id: district_id,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (result) {
                        $('#ward').html(result)
                    },
                })
            });
        })
    </script>


@endsection
