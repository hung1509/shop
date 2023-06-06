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
                <h3 class="card-title">Sửa danh mục</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('admin.category.update', ['id'=>$data->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tên danh mục</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="{{$data->name}}">
                  </div>
                  <div class="form-lable row">
                    <div class="col-3">
                        <label>Danh mục cha</label>
                        <select name="category_id" class="form-control">
                          <option>--Chọn danh mục--</option>
                          @foreach($category as $key =>$val)
                            <option value="{{$val->id}}" {{($val->id == $data->parent_id) ? 'selected':''}}>{{$val->name}}</option>
                          @endforeach
                        </select>
                    </div>
                  </div>
                  <div class="form-check ">
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