@extends('admin.layouts.app')
@section('content')
    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Thêm mới người dùng</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-form-label">Tên người dùng:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" placeholder="Nhập tên người dùng">
                        @error('name')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" placeholder="Nhập email">
                        @error('email')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 col-form-label">Số điện thoại:</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="phone" placeholder="Nhập số điện thoại">
                        @error('phone')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 col-form-label">Mật khẩu:</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" placeholder="Mật khẩu" id="pwd">
                        <p style="cursor: pointer" id="showHidePassword" onclick="showHidePassword()" class="mt-2">Show password</p>
                        @error('password')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 col-form-label">Quyền:</label>
                    <div class="d-flex">
                        <div class="justify-content-center align-content-center">
                            <input type="radio" id="is_admin" name="is_admin" value="1">
                            <label for="is_admin">Người quản trị</label><br></div>
                        <div class="justify-content-center align-content-center ml-5">
                            <input type="radio" id="not_admin" name="is_admin" value="0">
                            <label for="not_admin">Người dùng</label><br>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 col-form-label">Trạng thái:</label>
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
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-dark mb-2">Thêm mới</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
    </script>
@endsection
