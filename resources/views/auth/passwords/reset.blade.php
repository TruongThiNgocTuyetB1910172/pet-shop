<base href="/">
    <!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Cập nhật mật khẩu</title>
    <link href="{{ asset('form/css/style.css') }}" rel="stylesheet">

</head>

<body class="h-100">

<div id="preloader">
    <div class="loader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
        </svg>
    </div>
</div>

<div class="login-form-bg h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="col-xl-6">
                <div class="form-input-content">
                    <div class="card login-form mb-0">
                        <div class="card-body pt-5">
                            <h4 class="text-center text-uppercase">Cập nhật mật khẩu</h4>
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group">
                                    <label for="email" class="form-label"> <strong>{{ __('Địa chỉ email:') }}</strong></label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email }}" required autocomplete="email" autofocus readonly>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-label"> <strong>{{ __('Mật khẩu:') }}</strong></label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password-confirm" class="form-label"> <strong>{{ __('Xác nhận mật khẩu:') }}</strong></label>

                                    <div >
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                    <div>
                                        <button type="submit" class="btn btn-primary mt-3 w-100">
                                            {{ __('Cập nhật mật khẩu') }}
                                        </button>
                                    </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('form/plugins/common/common.min.js') }}"></script>
<script src="{{ asset('form/js/custom.min.js') }}"></script>
<script src="{{ asset('form/js/settings.js') }}"></script>
<script src="{{ asset('form/js/gleek.js') }}"></script>
<script src="{{ asset('form/js/styleSwitcher.js') }}"></script>
</body>
</html>


