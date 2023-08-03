@extends('admin.layouts.app')

@section('title', 'Cập nhật dịch vụ: ' . $service->name)

@section('content')
    <div><h4 class="card-title text-uppercase">Cập nhật dịch vụ: {{ $service->name }}</h4></div>
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
                <form action="{{ route('service.update', ['id' => $service->id]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <div class="form-group">
                        <label class="form-label"><strong>Tên sản phẩm:</strong></label>
                        <div>
                            <input type="text" class="form-control" name="name" value="{{ $service->name }}" placeholder="Nhập tên sản phâm">
                            @error('name')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><strong>Mô tả:</strong></label>
                        <div>
                            <textarea type="text" class="form-control" id="editor" name="description" placeholder="Nhập mô tả">{{ $service->description }}</textarea>
                            @error('description')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><strong>Giá Gốc:</strong></label>
                        <div>
                            <input type="text" class="form-control" name="original_price" value="{{ $service->original_price }}" placeholder="Nhập giá gốc">
                            @error('original_price')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><strong>Giá Bán:</strong></label>
                        <div>
                            <input type="text" class="form-control" name="selling_price" value="{{ $service->selling_price }}" placeholder="Nhập giá bán">
                            @error('selling_price')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><strong>Hình ảnh:</strong></label>
                        <div>
                            <img src="{{( 'storage/'.$service->image) }}" alt="{{ $service->name }}" height="100px" width="100px"
                                 class="img-fluid">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="mb-3">
                            <label for="editor" class="form-label"><strong>Chọn ảnh thay thế: </strong></label>
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
                            <button type="submit" class="btn btn-dark">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
