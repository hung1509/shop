@extends('admin.layouts.main')
@section('content')
    <div class="row">
    <div class="card col-12">
              <div class="card-header">
                <h3 class="card-title">Thêm biểu ngữ</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('admin.banner.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tên đề</label>
                    <input type="text" name="title" class="form-control" id="exampleInputEmail1">
                  </div>
                  <div class="form-group">
                      <label>Mô tả</label>
                      <div>
                        <textarea class="form-control" name="description"></textarea>
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