@extends('admin.layouts.app')
@section('head')
    <style>
        .form-file-group{
            width: 100%;
            border: 2px dashed #000;
        }
        .form-file-group p {
            width: 100%;
            text-align: center;
            line-height: 170px;
        }
    </style>
    <script src="ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <form action="{{ route('banner.update' ,['id' => $banner->id]) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card">
            <div class="form-group row">
                <form>
                    <label class="col-sm-2 col-form-label">Status:</label>
                    <div>
                        <input type="radio"  name="status" value="1">
                        <label for="html">Yes</label><br>
                        <input type="radio"  name="status" value="0">
                        <label for="css">No</label><br>
                    </div>


                </form>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Hình ảnh:</label>
                <div class="col-sm-10">
                    <img src="{{( 'storage/'.$banner->image) }}"
                         class="rounded avatar-xs" width="50px" height="50px">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Hình ảnh:</label>
                <div class="col-sm-10">
                    <input type="file" accept="image/*" class="form-control" name="image" >

                    @error('image')
                    <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-dark mb-2">Submit</button>
                </div>
            </div>
        </div>
        </div>
    </form>

@endsection
@section('footer')
    <script>
        CKEDITOR.replace( 'editor' );

        function previewFile(input){
            let file = $("input[type=file]").get(0).files[0];
            if(file){
                let reader = new FileReader();
                reader.onload = function (){
                    $("#previewImg").attr('src', reader.result);
                    $("#previewBox").css('display', 'block');
                }
                $(".form-file-group").css('display', 'none');
                reader.readAsDataURL(file);
            }
        }
        function removePreview(){
            $("#previewImg").attr('src',"");
            $("#previewBox").css('display', 'none');
            $(".form-file-group").css('display', 'block');
        }
    </script>
@endsection

@section('head')
    <style>
        .form-file-group{
            width: 100%;
            border: 2px dashed #000;
        }
        .form-file-group p {
            width: 100%;
            text-align: center;
            line-height: 170px;
        }
        .img-fluid rounded{
            width: 50px;
            height: 50px;
        }
    </style>
@endsection
