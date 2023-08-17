@extends('admin.layouts.app')

@section('title','Thêm biến thể dịch vụ')

@section('content')
    <div> <h4 class="card-title text-uppercase">Thêm mới biến thể dịch vụ</h4></div>
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
                <form action="{{ route('variant-service.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label"> <strong>Tên dịch vụ:</strong></label>
                        <div class="form-group">
                            <select class="form-control" name="service_id" >
                                <option >Chọn tên dịch vụ</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}" >{{ $service->name }}</option>
                                @endforeach
                                @error('service_id')
                                <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </select>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label"> <strong>Danh sách loài:</strong></label>
                        <div class="form-group">
                            <select class="form-control" name="animal_detail_id" >
                                <option >Chọn loài</option>
                                @foreach ($animalDetails as $animalDetail)
                                    <option value="{{ $animalDetail->id }}" >{{ $animalDetail->animal->name }}, Cân nặng:{{ $animalDetail->weight }} </option>
                                @endforeach
                                @error('animal_detail_id')
                                <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </select>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" ><strong>Giá: </strong></label>
                        <div >
                            <input type="text" class="form-control" name="price" placeholder="Nhập giá bán">
                            @error('price')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-dark">Thêm mới</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

