@extends('admin.layouts.app')

@section('title','Thêm chi tiết mới')

@section('content')
    <div><h4 class="card-title text-uppercase">Thêm mới chi tiết</h4></div>
    <form action="{{ route('animal-detail.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label"><strong>Danh mục loài: </strong></label>
                    <div >
                        <select class="form-control" name="animal_id" >
                            <option value="">Select a Category</option>
                            @foreach ($animals as $animal )
                                <option value="{{ $animal->id }}">{{ $animal->name }}</option>

                            @endforeach
                        </select>
                        @error('animal_id')
                        <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label"><strong>Cân nặng:</strong></label>
                    <div>
                        <input type="text" class="form-control" name="weight" placeholder="Nhập số cân">
                        @error('weight')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
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

