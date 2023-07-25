@extends('admin.layouts.app')

@section('content')
    <form action="{{ route('district.store') }}" method="POST">
        @csrf
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create District </h4>
                    <div class="basic-form">

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name District:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" placeholder="Nhập tên huyen">
                                @error('name')
                                <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Province:</label>
                            <div class="col-sm-10">
                                <select class="select-form" name="province_id" >
                                    <option value="">Select a Province</option>

                                    @foreach ($provinces as $province )
                                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                                @error('province_id')
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
