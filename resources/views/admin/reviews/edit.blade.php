@extends('admin.layouts.app')

@section('content')
    <div class="my-3">
        <section class="content">
            <div class="container-fluid">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Cập nhật bình luận</h3>
                    </div>
                    <form action="{{ route('review.update' ,['id' => $review->id]) }}" method="POST" >
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <label class="form-label"> <strong>Trạng thái:</strong></label>
                            <div class="d-flex">
                                <div class="justify-content-center align-content-center">
                                    <input type="radio" name="status" value="1" @if($review->status == 1) checked @endif>
                                    <label for="is_active">Hiển thị</label><br></div>
                                <div class="justify-content-center align-content-center ml-5">
                                    <input type="radio" name="status" value="0" @if($review->status == 0) checked @endif>
                                    <label for="is_block">Ẩn</label><br>
                                </div>
                            </div>
                            <div>
                                <label >Bình luận</label>
                                <p class="form-control">{{ $review->comment }}</p>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection


