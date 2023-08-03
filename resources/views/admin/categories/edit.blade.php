@extends('admin.layouts.app')

@section('title', 'Cập nhật danh mục')

@section('content')
    <div> <h4 class="card-title text-uppercase">Cập nhật danh mục: {{$category->name}}</h4></div>
    @csrf
    <div class="card">
        <div class="basic-form">
            <form action="{{ route('category.update', ['id' => $category->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label"> <strong>Tên danh mục: </strong></label>
                        <input type="text" class="form-control input-default" name="name" value="{{ $category->name}}" >
                        @error('name')
                        <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-dark mb-2">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
@endsection
