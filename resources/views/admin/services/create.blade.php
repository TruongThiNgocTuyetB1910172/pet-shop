@extends('admin.layouts.app')

@section('title','Thêm dịch vụ')

@section('content')
    <div> <h4 class="card-title text-uppercase">Thêm mới dịch vụ</h4></div>
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
                <form action="{{ route('service.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-label"><strong>Tên dịch vụ:</strong></label>
                        <div>
                            <input type="text " class="form-control" name="name" placeholder="Nhập tên dịch vụ">
                            @error('name')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label"> <strong>Danh mục loai:</strong></label>
                        <div class="form-check mt-3 ">
                            <label class="form-check-label">
                                @foreach($animal_details as $animal_detail)
                                    <div class="form-check mt-3 ">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="{{ $animal_detail->id }}" name="animal_ids">
                                            {{ $animal_detail->animal->name }}: giống ({{ $animal_detail->variant }}) - cân nặng({{ $animal_detail->weight }})

                                            @error('animal_ids')
                                            <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </label>
                                    </div>
                                @endforeach
                            </label>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="form-label"><strong>Mô tả:</strong></label>
                        <div>
                            <textarea type="text" class="form-control" id="editor" name="description" placeholder="Nhập mô tả"></textarea>
                            @error('description')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><strong>Giá:</strong></label>
                        <div>
                            <input type="text" class="form-control" name="price" placeholder="Nhập giá bán">
                            @error('price')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="mb-3">
                            <label for="editor" class="form-label"><strong>Chọn ảnh:</strong></label>
                            <div class="form-file-group">
                                <input type="file" name="image" style="display: none" id="file-upload"
                                       onchange="previewFile(this)">
                                <p onclick="document.querySelector('#file-upload').click()">
                                    Nhấn vào đây để chọn ảnh tải lên.
                                </p>
                            </div>
                            <div id="previewBox" style="display: none" class="text-center">
                                <img src="" id="previewImg" class="img-fluid rounded" width="100px" height="100px">
                                <i class="uil-trash-alt text-danger" style="cursor: pointer"
                                   onclick="removePreview()">Xóa ảnh</i>
                            </div>

                            @error('image')
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

