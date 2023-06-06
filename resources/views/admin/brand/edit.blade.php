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
                <h3 class="card-title">Sửa nhãn hiệu</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('admin.brand.update', ['id'=>$data->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tên danh mục</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="{{$data->name}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Website</label>
                    <input type="text" name="website" class="form-control" id="exampleInputEmail1" value="{{$data->website}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Chọn logo</label>
                    <label for="exampleInputFile" class="previewImg d-block" style="height: 170px; width: 170px;">
                            <input type="file" class="input_img" id="exampleInputFile" name="new_image" onchange="preview(this)">
                            <img class="pre-image preview" src="{{asset($data->image)}}" alt="" width="100%" height="100%">
                            <div class="plus">
                              <i class="fa-solid fa-plus"></i>
                            </div>
                      </label>
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