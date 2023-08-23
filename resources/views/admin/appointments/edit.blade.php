@extends('admin.layouts.app')

@section('title','Thêm cuộc hẹn mới')

@section('content')
    <div><h4 class="card-title text-uppercase">Cập nhật cuộc hẹn</h4></div>
    <form action="{{ route('appointment.update',['id' => $appointment->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label"><strong>Tên khách hàng:</strong></label>
                    <div>
                        <input type="text" class="form-control" name="name" value="{{$appointment->name}}" placeholder="Nhập tên người dùng">
                        @error('name')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label"><strong>Email:</strong></label>
                    <div>
                        <input type="email" class="form-control" name="email"  value="{{$appointment->email}}"placeholder="Nhập email">
                        @error('email')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label"><strong>Số điện thoại:</strong></label>
                    <div>
                        <input type="number" class="form-control" name="phone" value="{{$appointment->phone}}" placeholder="Nhập số điện thoại">
                        @error('phone')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label"><strong>Ngày đặt lịch:</strong></label>
                    <div>
                        <input type="datetime-local" class="form-control" name="appointment_at" value="{{$appointment->appointment_at}}" id="appointment_at" >
                        @error('appointment_at')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label"><strong>Ghi chú: </strong></label>
                    <div >
                        <textarea type="text" class="form-control" id="editor" name="notes" placeholder="Nhập ghi chú">{{$appointment->notes}}</textarea>
                        @error('notes')
                        <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label"> <strong>Trạng thái: </strong></label>
                    <div class="d-flex">
                        <div class="justify-content-center align-content-center">
                            <input type="radio" id="is_active" name="status" value="1" @if($appointment->status == 1) checked @endif>
                            <label for="is_active">Đã xử lý</label><br></div>
                        <div class="justify-content-center align-content-center ml-5">
                            <input type="radio" id="is_block" name="status" value="0" @if($appointment->status == 0) checked @endif>
                            <label for="is_block">Chưa xử lý</label><br>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-dark mb-2">Cập nhât</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

