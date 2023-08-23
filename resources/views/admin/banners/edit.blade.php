@extends('admin.layouts.app')

@section('title', 'Cập nhật banner')

@section('content')
    <div><h4 class="card-title text-uppercase">Cập nhật banner</h4></div>
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
                <form action="{{ route('banner.update' ,['id' => $banner->id]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label class="form-label"> <strong>Trạng thái: </strong></label>
                        <div class="d-flex">
                            <div class="justify-content-center align-content-center">
                                <input type="radio" id="is_active" name="status" value="1" @if($banner->status == 1) checked @endif>
                                <label for="is_active">Hiện</label><br></div>
                            <div class="justify-content-center align-content-center ml-5">
                                <input type="radio" id="is_block" name="status" value="0" @if($banner->status == 0) checked @endif>
                                <label for="is_block">Ẩn</label><br>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label"><strong>Hình ảnh: </strong></label>
                        <div class="col-sm-10">
                            <img src="{{( 'storage/'.$banner->image) }}" alt="{{ $banner->name }}"
                                 class="img-fluid" width="100px", height="100px">
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
                        <button type="submit" class="btn btn-dark mb-2">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
