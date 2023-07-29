@extends('admin.layouts.app')

@section('content')
    <form action="{{ route('user.update', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">New User</h4>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Name user:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="Write name user">
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
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="Write email">
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
                        <input type="number" class="form-control" name="phone" value="{{ $user->phone }}" placeholder="Write phone number">
                        @error('phone')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Old Password:</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="old_password"  placeholder="write old password" >
                        @error('old_password')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Password:</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="password"  placeholder="write new password">
                        @error('password')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <form>
                    <label class="col-sm-2 col-form-label">Is_admin:</label>
                    <div>
                        <input type="radio" id="html" name="is_admin" value="1">
                        <label for="html">Yes</label><br>
                        <input type="radio" id="css" name="is_admin" value="0">
                        <label for="css">No</label><br>
                        @error('is_admin')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                </form>
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


