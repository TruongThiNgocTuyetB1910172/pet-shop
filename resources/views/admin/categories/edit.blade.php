@extends('admin.layouts.app')

@section('content')
    <form action="{{ route('category.update', ['id' => $categories->id]) }}" method="POST">
        @method('PUT')
        @csrf

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Category</h4>
                    <div class="basic-form">
                        <div class="form-group">
                            <input type="text" class="form-control input-default" name="name" value="{{ $categories->name }}" placeholder="Name category">

                            @error('name')
                            <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-dark mb-2">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
