<div>
        <!DOCTYPE html>
        <html lang="en">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <head>
            <title>Checkout</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <link rel="icon" type="image/png" href="asset/images/icons/favicon.png" />

            <link rel="stylesheet" type="text/css" href="asset/vendor/bootstrap/css/bootstrap.min.css">

            <link rel="stylesheet" type="text/css" href="asset/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

            <link rel="stylesheet" type="text/css" href="asset/fonts/linearicons-v1.0.0/icon-font.min.css">

            <link rel="stylesheet" type="text/css" href="asset/vendor/animate/animate.css">

            <link rel="stylesheet" type="text/css" href="asset/vendor/css-hamburgers/hamburgers.min.css">

            <link rel="stylesheet" type="text/css" href="asset/vendor/animsition/css/animsition.min.css">

            <link rel="stylesheet" type="text/css" href="asset/vendor/select2/select2.min.css">

            <link rel="stylesheet" type="text/css" href="asset/vendor/daterangepicker/daterangepicker.css">

            <link rel="stylesheet" type="text/css" href="asset/vendor/slick/slick.css">

            <link rel="stylesheet" type="text/css" href="asset/vendor/lightbox2/css/lightbox.min.css">

            <link rel="stylesheet" type="text/css" href="asset/vendor/perfect-scrollbar/perfect-scrollbar.css">

            <link rel="stylesheet" type="text/css" href="asset/css/util.css">
            <link rel="stylesheet" type="text/css" href="asset/css/main.css">
            @livewireStyles

        </head>
        <body class="animsition">
        <div class="bg0 p-t-95 p-b-50">
            <div class="container">
                <form wire:submit.prevent="checkout">
                    <div class="p-t-17 p-b-70">

                        <div class="m-t-35 dis-none js-panel1">
                            <div class="size-w-60 flex-w m-rl-auto">
                                <input class="bo-all-1 bo cl15 focus1 size-a-37 txt-s-120 cl3 plh2 p-rl-20 w-full-sm" type="text"
                                       name="coupon" placeholder="Coupon code">
                                <button class="bg10 size-a-36 txt-s-105 cl0 p-rl-15 trans-04 hov-btn2 mt-4 mt-sm-0 w-full-sm">
                                    Apply coupon
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 col-lg-8 p-b-50">
                            <div>
                                <h4 class="cl3 p-b-19 text-uppercase">
                                    <strong>Chi tiết thanh toán</strong>
                                </h4>
                                <div class="mb-2"><strong>Chọn địa chỉ giao hàng</strong> <span style="color: red">*</span></div>
                                @foreach($addresses as $key => $address)
                                    <div class="flex-w flex-sb-m cl6 bo-b-1 bo cl15 p-b-21 p-t-18">
                                        <div class="form-check">
                                            <input
                                                wire:model.live="addressId"
                                                name="addressId"
                                                class="form-check-input"
                                                type="radio"
                                                value="{{ $address->id }}"
                                                id="{{ $key }}">
                                            <label class="form-check-label" for="{{ $key }}">
                                                {{$address->user_name}},
                                                {{$address->phone_number}},
                                                {{ $address->house_number }},
                                                {{ $address->ward->name }},
                                                {{ $address->district->name}},
                                                {{ $address->province->name }}
                                            </label>
                                        </div>
                                        <div><a href="{{ route('address.delete', ['id' => $address->id]) }}" style="color: red"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>
                                        </span>
                                    </div>
                                @endforeach

                                @error('addressId')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <hr>
                                <div class="btn btn-success"><a href="{{ route('location.new-add') }}" style="color: white">Thêm địa chỉ</a></div>
                                <hr>
                                <h4 class="txt-m-124 cl3 p-b-19">
                                    Thêm thông tin
                                </h4>
                                <div>
                                    <div class="txt-s-101 cl6 p-b-10">
                                        Ghi chú của bạn
                                    </div>
                                    <textarea class="plh2 txt-s-120 cl3 size-a-38 bo-all-1 bo cl15 p-rl-20 p-tb-10 focus1"
                                              wire:model="notes"
                                              placeholder="Note about your order, eg. special notes fordelivery."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 col-lg-4 p-b-50">
                            <div class="how-bor4 p-t-35 p-b-40 p-rl-30 m-t-5">
                                <h4 class="cl3 p-b-19 text-uppercase">
                                    Đơn hàng của bạn
                                </h4>
                                <div class="flex-w flex-sb-m txt-m-103 cl6 bo-b-1 bo cl15 p-b-21 p-t-18">
                            <span>
                                Sản phẩm
                            </span>
                                    <span>
                                Thành tiền
                            </span>
                                </div>

                                <div class="flex-w flex-sb-m txt-s-101 cl6 bo-b-1 bo cl15 p-b-21 p-t-18">

                                    @foreach( $cartItems as $item )

                                        <span>
                                {{ $item->product->name }}
                                x{{$item->quantity}}
                            </span>
                                        <span>
                               {{ CurrencyHelper::format($item->product->selling_price*$item->quantity) }}
                            </span>
                                    @endforeach
                                </div>


                                <div class="flex-w flex-m txt-m-103 bo-b-1 bocl15 p-tb-23">
                                </div>
                                <div class="flex-w flex-m txt-m-103 p-tb-23">
                                    <span class="size-w-61 cl6">
                                        Tổng cộng
                                    </span>
                                            <span class="size-w-62 cl10">
                                        {{ CurrencyHelper::format($total) }}
                                    </span>
                                </div>
                                <button type="submit" class=" flex-c-m txt-s-105 cl0 bg10 size-a-21 hov-btn2 trans-04 p-rl-10" >
                                    Đặt hàng
                                </button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
        <script src="asset/vendor/jquery/jquery-3.2.1.min.js"></script>

        <script src="asset/vendor/animsition/js/animsition.min.js"></script>

        <script src="asset/vendor/bootstrap/js/popper.js"></script>
        <script src="asset/vendor/bootstrap/js/bootstrap.min.js"></script>

        <script src="asset/vendor/select2/select2.min.js"></script>

        <script src="asset/vendor/daterangepicker/moment.min.js"></script>
        <script src="asset/vendor/daterangepicker/daterangepicker.js"></script>

        <script src="asset/vendor/slick/slick.min.js"></script>
        <script src="asset/js/slick-custom.js"></script>

        <script src="asset/vendor/parallax100/parallax100.js"></script>

        <script src="asset/vendor/lightbox2/js/lightbox.min.js"></script>

        <script src="asset/vendor/isotope/isotope.pkgd.min.js"></script>

        <script src="asset/vendor/sweetalert/sweetalert.min.js"></script>

        <script src="asset/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>

        <script src="asset/js/main.js"></script>
        </body>
        </html>

</div>
