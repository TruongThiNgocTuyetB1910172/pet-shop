@extends('admin.layouts.app')
@section('content')
    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">New User</h4>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Name user:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" placeholder="Write name user">
                        @error('name')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" placeholder="Enter email">
                        @error('email')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Phone number:</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="phone" placeholder="Enter phone number">
                        @error('phone')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Password:</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" placeholder="Enter password" id="pwd">
                        <p style="cursor: pointer" id="showHidePassword" onclick="showHidePassword()" class="mt-2">Show password</p>
                        @error('password')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Is Admin:</label>
                    <div class="d-flex">
                        <div class="justify-content-center align-content-center">
                            <input type="radio" id="is_admin" name="is_admin" value="1">
                            <label for="is_admin">Yes</label><br></div>
                        <div class="justify-content-center align-content-center ml-5">
                            <input type="radio" id="not_admin" name="is_admin" value="0">
                            <label for="not_admin">No</label><br>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Is Active:</label>
                    <div class="d-flex">
                        <div class="justify-content-center align-content-center">
                            <input type="radio" id="is_active" name="status" value="1">
                            <label for="is_active">Yes</label><br></div>
                        <div class="justify-content-center align-content-center ml-5">
                            <input type="radio" id="is_block" name="status" value="0">
                            <label for="is_block">No</label><br>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-dark mb-2">Submit</button>
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
