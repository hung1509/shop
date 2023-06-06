@extends('admin.layouts.main')
@section('content')
    <div class="row">
    <div class="card col-12">
              <div class="card-header">
                <h3 class="card-title">Thêm vai trò</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('admin.role.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tên vai trò</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1">
                  </div>
                  <div class="form-group">
                      <label>Mô tả</label>
                      <div>
                        <textarea class="form-control" name="description"></textarea>
                      </div>
                  </div>
                  <div class="form-group d-flex justify-content-between">
                      <label>Phân quyền</label>
                      <div>
                            <input type="checkbox" class=" form-check-input checkbox_all" id="all">
                            <label class="form-check-label" for="all">Tất cả</label>
                      </div>
                  </div>
                    @foreach($permission as $key => $val)
                  <div class="form-group">
                        <div class="card col-12 px-0 card-parent">
                            <div class="card-header bg-success">
                                <div class="form-check col-3">
                                    <input type="checkbox" class=" form-check-input checkbox_parent" id="{{$val->id}}">
                                    <label class="form-check-label" for="{{$val->id}}">{{$val->name}}</label>
                                </div>
                            </div>
                            <div class="card-body row">
                                @foreach($val->permissionChildren as $permissionChildrenItem)
                                <div class="form-check col-3">
                                    <input type="checkbox" name="permission_id[]" class="form-check-input checkbox_children" id="{{$permissionChildrenItem->id}}" value="{{$permissionChildrenItem->id}}">
                                    <label class="form-check-label" for="{{$permissionChildrenItem->id}}">{{$permissionChildrenItem->name}}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                  </div>
                  @endforeach
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
              </form>
            </div>
    </div>
@endsection