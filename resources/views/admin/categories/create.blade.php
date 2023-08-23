@extends('admin.layouts.app')

@section('title', 'Thêm mới danh mục')

@section('content')
    <div> <h4 class="card-title text-uppercase">Thêm mới danh mục</h4></div>
    @csrf
    <div class="card">
        <div class="basic-form">
            <form action="{{ route('category.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label"> <strong>Tên danh mục: </strong></label>
                        <input type="text" class="form-control input-default" name="name" placeholder="Nhập tên danh mục">
                        @error('name')
                        <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-dark mb-2">Thêm mới</button>
                </div>
            </form>
        </div>
    </div>
@endsection
