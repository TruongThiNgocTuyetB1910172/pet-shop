@extends('admin.layouts.app')

@section('content')
    <form action="{{ route('province.store') }}" method="POST">
        @csrf
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create Province</h4>
                    <div class="basic-form">
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control input-default" name="name" placeholder="Name province">

                                @error('name')
                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-dark mb-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
