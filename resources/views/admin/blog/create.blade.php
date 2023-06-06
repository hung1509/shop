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
                <h3 class="card-title">Thêm blog</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('admin.blog.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tiêu đề</label>
                    <input type="text" name="title" class="form-control" id="exampleInputEmail1">
                  </div>
                  <div class="form-group">
                      <label>Nội dung</label>
                      <div>
                        <textarea class="form-control" rows="30" name="content"></textarea>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputFile">Chọn ảnh</label>
                      <label for="exampleInputFile" class="previewImg d-block" style="height: 370px; width: 780px;">
                            <input type="file" class="input_img" id="exampleInputFile" name="image" onchange="preview(this)">
                            <img class="pre-image preview" src="" alt="">
                            <div class="plus">
                              <i class="fa-solid fa-plus"></i>
                            </div>
                      </label>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1" name="is_active">
                      <label class="form-check-label" for="exampleCheck1">Kích hoạt</label>
                    </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
              </form>
            </div>
    </div>
@endsection