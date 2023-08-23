@extends('admin.layouts.app')

@section('title','Cập nhât người dùng')

@section('content')
    <div><h4 class="card-title text-uppercase">Cập nhật người dùng: {{ $user->name }}</h4></div>
    <form action="{{ route('user.update', ['id' => $user->id]) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label"><strong>Tên người dùng:</strong></label>
                    <div>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" >
                        @error('name')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label"><strong>Email:</strong></label>
                    <div>
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" readonly disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label"><strong>Số điện thoại:</strong></label>
                    <div>
                        <input type="number" class="form-control" name="phone" value="{{ $user->phone }}" >
                        @error('phone')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label"><strong>Quyền:</strong></label>
                    <div class="d-flex">
                        <div class="justify-content-center align-content-center">
                            <input type="radio" id="is_admin" name="is_admin" value="1" @if($user->is_admin == 1) checked @endif>
                            <label for="is_admin">Quản trị</label><br></div>
                        <div class="justify-content-center align-content-center ml-5">
                            <input type="radio" id="not_admin" name="is_admin" value="0" @if($user->is_admin == 0) checked @endif>
                            <label for="not_admin">Người dùng</label><br>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label"><strong>Trạng thái:</strong></label>
                    <div class="d-flex">
                        <div class="justify-content-center align-content-center">
                            <input type="radio" id="is_active" name="status" value="1" @if($user->status == 1) checked @endif>
                            <label for="is_active">Hoạt động</label><br></div>
                        <div class="justify-content-center align-content-center ml-5">
                            <input type="radio" id="is_block" name="status" value="0" @if($user->status == 0) checked @endif>
                            <label for="is_block">Block</label><br>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                        <button type="submit" class="btn btn-dark mb-2">Cập nhật</button>
                </div>
            </div>
        </div>
    </form>

    <div><h4 class="card-title text-uppercase">Cập nhật mật khẩu</h4></div>
    <form action="{{ route('user.update-password', ['id' => $user->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label"><strong>Mật khẩu mới:</strong></label>
                    <div >
                        <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu mới" id="pwd">
                        <p style="cursor: pointer" id="showHidePassword" onclick="showHidePassword()" class="mt-2"><em>Hiện mật khẩu</em></p>
                        @error('password')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                        <button type="submit" class="btn btn-dark mb-2">Cập nhật</button>
                </div>
            </div>
        </div>
    </form>

@endsection

@section('footer')
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
@endsection


