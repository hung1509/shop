@extends('admin.layouts.main')
@section('content')
    <div class="row">
    <div class="card col-12">
              <div class="card-header">
                <h3 class="card-title">Sửa blog</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('admin.blog.update', ['id'=>$data->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tiêu đề</label>
                    <input type="text" name="title" class="form-control" id="exampleInputEmail1" value="{{$data->title}}">
                  </div>
                  <div class="form-group">
                      <label>Nội dung</label>
                      <div>
                        <textarea class="form-control" rows="30" name="content">{{$data->content}}</textarea>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputFile">Chọn ảnh</label>
                      <label for="exampleInputFile" class="previewImg d-block" style="height: 370px; width: 780px;">
                            <input type="file" class="input_img" id="exampleInputFile" name="new_image" onchange="preview(this)">
                            <img class="pre-image preview" src="{{$data->image}}" alt="" width="100%" height="100%">
                            <div class="plus">
                              <i class="fa-solid fa-plus"></i>
                            </div>
                      </label>
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