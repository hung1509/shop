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
                <h3 class="card-title">Thêm sản phẩm</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('admin.product.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1">
                  </div>
                  <div class="form-group row">
                    <div class="col-4">
                        <label for="exampleInputEmail1">Giá</label>
                        <input type="text" name="price" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="col-4">
                        <label for="exampleInputEmail1">Số Lượng</label>
                        <input type="text" name="quantity" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="col-4">
                        <label for="exampleInputEmail1">Giảm giá</label>
                        <input type="text" name="sale" class="form-control" id="exampleInputEmail1">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-2">
                        <label>Chọn size </label>
                      </div>
                      @foreach($size as $key => $val)
                      <div class="col-1">
                        <input type="checkbox" name="size-{{$key}}" class="form-check-input" value="{{$val->id}}">
                        <label class="form-check-label">{{$val->name}}</label>
                      </div>
                      @endforeach
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Thêm ảnh</label>
                    <div class="row">
                      <div class="col-lg-3 col-md-6 col-sm-12 d-flex flex-column align-items-center">
                        <label for="image-main" class="previewImg d-block" style="height: 230px; width: 170px;">
                              <input type="file" class="input_img" id="image-main" name="image" onchange="preview(this)">
                              <img class="pre-image preview" src="" alt="">
                              <div class="plus">
                                <i class="fa-solid fa-plus"></i>
                              </div>
                        </label>
                        <label for="image-main">Ảnh chính</label>
                      </div>
                      @for($i = 1; $i <= 3; $i++) 
                      <div class="col-lg-3 col-md-6 col-sm-12 d-flex flex-column align-items-center">
                        <label for="image-{{$i}}" class="previewImg d-block" style="height: 230px; width: 170px;">
                              <input type="file" class="input_img" id="image-{{$i}}" name="image-{{$i}}" onchange="preview(this, '{{$i}}')">
                              <img class="pre-image preview-{{$i}}" src="" alt="">
                              <div class="plus">
                                <i class="fa-solid fa-plus"></i>
                              </div>
                        </label>
                        <label for="image-{{$i}}">Ảnh {{$i}}</label>
                      </div>
                      @endfor
                      </div>
                    </div>
                  <div class="form-group row">
                    <div class="col-3">
                        <label>Danh mục</label>
                        <select name="category_id" class="form-control">
                          <option>--Chọn danh mục--</option>
                          @foreach($category as $key =>$val)
                            <option value="{{$val->id}}">{{$val->name}}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <label>Thương hiệu</label>
                        <select name="brand_id" class="form-control">
                          <option>--Chọn thương hiệu--</option>
                          @foreach($brand as $key =>$val)
                            <option value="{{$val->id}}">{{$val->name}}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <label>Nhà cung cấp</label>
                        <select name="vendor_id" class="form-control">
                          <option>--Chọn nhà cung cấp--</option>
                          @foreach($vendor as $key =>$val)
                            <option value="{{$val->id}}">{{$val->name}}</option>
                          @endforeach
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                      <label>Mô tả</label>
                      <div>
                        <textarea class="form-control" name="description"></textarea>
                      </div>
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="is_active">
                    <label class="form-check-label" for="exampleCheck1">Kích hoạt</label>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
              </form>
            </div>
    </div>
@endsection