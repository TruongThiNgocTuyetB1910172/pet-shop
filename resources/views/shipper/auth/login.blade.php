<base href="/">
<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Đăng nhập</title>
    <link href="form/css/style.css" rel="stylesheet">

</head>

<body class="h-100">

<div id="preloader">
    <div class="loader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
        </svg>
    </div>
</div>

<section class="vh-100" style="background-color: #FFFFFF;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="https://images.pexels.com/photos/1314550/pexels-photo-1314550.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                                 alt="login form"  style="border-radius: 1rem 0 0 1rem;"  class="img-fluid"/>
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">

                                <form  method="POST" action="{{ route('shipper.login') }}">
                                    @csrf
                                    <div class="d-flex align-items-center mb-3 pb-1 text-center">
                                        <span class="h1 fw-bold mb-0 ">Đăng nhập</span>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example17">{{ __('Địa chỉ email') }}</label>
                                        <input type="email" id="form2Example17" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Nhập email"/>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example27">{{ __('Mật khẩu') }}</label>
                                        <input type="password" id="form2Example27" placeholder="Mật khẩu" class="form-control" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"/>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div >
                                        @if (Route::has('password.request'))
                                            <a  href="{{ route('password.request') }}">
                                                {{ __('Quên mật khẩu ?') }}
                                            </a>
                                        @endif
                                    </div>
                                    <p class="mb-3 pb-lg-2" style="color: #393f81;">Bạn chưa có tài khoản? <a href="{{ route('register') }}"
                                        >Đăng kí </a></p>

                                    <div class="pt-1 mb-4">
                                        <button class="btn btn-primary btn-lg btn-block" type="submit"> {{ __('Đăng nhập') }}</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="form/plugins/common/common.min.js"></script>
<script src="form/js/custom.min.js"></script>
<script src="form/js/settings.js"></script>
<script src="form/js/gleek.js"></script>
<script src="form/js/styleSwitcher.js"></script>
</body>
</html>
