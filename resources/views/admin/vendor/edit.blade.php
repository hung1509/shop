@extends('admin.layouts.main')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="my-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="row">
    <div class="card col-12">
              <div class="card-header">
                <h3 class="card-title">Sửa nhà cung cấp</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('admin.vendor.update', ['id'=>$data->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tên nhà cung cấp</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="{{$data->name}}">
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="exampleInputEmail1">Số điện thoại</label>
                      <input type="text" name="phone" class="form-control" id="exampleInputEmail1" value="{{$data->phone}}">
                    </div>
                    <div class="form-group col-6">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="text" name="email" class="form-control" id="exampleInputEmail1" value="{{$data->email}}">
                    </div>
                  </div>
                  <div class="form-group">
                      <label>Địa chỉ</label>
                      <div>
                        <textarea class="form-control" name="address">{{$data->address}}</textarea>
                      </div>
                  </div>
                  <div class="form-check">
                    <input type="checkbox" {{($data->is_active==1)?'checked':''}} class="form-check-input" id="exampleCheck1" name="is_active">
                    <label class="form-check-label" for="exampleCheck1">Kích hoạt</label>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Sửa</button>
                </div>
              </form>
            </div>
    </div>
@endsection