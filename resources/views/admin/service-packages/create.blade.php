@extends('admin.layouts.app')

@section('title','Thêm gói dịch vụ')

@section('content')
    <div> <h4 class="card-title text-uppercase">Thêm gói dịch vụ mới</h4></div>
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
                <form action="{{ route('package-service.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-label"><strong>Tên gói dịch vụ:</strong></label>
                        <div >
                            <input type="text " class="form-control" name="name" placeholder="Nhập tên gói dịch vụ">
                            @error('name')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><strong>Mô tả:</strong></label>
                        <div >
                            <textarea type="text" class="form-control" id="editor" name="description" placeholder="Nhập mô tả"></textarea>
                            @error('description')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="editor" class="form-label"><strong>Chọn các dịch vụ thuộc gói dịch vụ: </strong></label>
                        @foreach($services as $service)
                            <div class="form-check mt-3 ">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" value="{{ $service->id }}" name="service_ids[]">
                                    {{ $service->name }}: giá gốc ({{ $service->original_price }}) - giá sale ({{ $service->selling_price }})

                                    @error('service_ids')
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                        @endforeach

                        <div class="mt-3">
                            <span class="text-danger"><strong>Nếu không thêm giá cho gói dịch vụ thì giá của gói dịch vụ được tự động tính theo giá các dịch vụ có trong gói</strong></span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="form-label"><strong>Giá Gốc:</strong></label>
                        <div>
                            <input type="text" class="form-control" name="original_price" placeholder="Nhập giá gốc">
                            @error('original_price')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><strong>Giá Bán:</strong></label>
                        <div>
                            <input type="text" class="form-control" name="selling_price" placeholder="Nhập giá bán">
                            @error('selling_price')
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

