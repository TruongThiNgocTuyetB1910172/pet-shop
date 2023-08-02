@extends('admin.layouts.app')

@section('content')
    <form action="{{ route('category.store') }}" method="POST">
        @csrf
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thêm mới danh mục</h4>
                    <div class="basic-form">
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control input-default" name="name" placeholder="Nhập tên danh mục">

                                @error('name')
                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-dark mb-2">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
