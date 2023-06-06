@extends('admin.layouts.main')
@section('content')
<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h1 class="card-title">Danh sách nhà cung cấp</h1>

                <form class="card-tools" action="{{route('admin.vendor.index')}}">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="keysearch" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
              <a href="{{route('admin.vendor.create')}}" style="width: 180px;" class="btn btn-primary my-4 mx-3">Thêm nhà cung cấp</a>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Tên danh mục</th>
                      <th>Địa chỉ</th>
                      <th>Email</th>
                      <th>Số điện thoại</th>
                      <th>Trạng thái</th>
                      <th>Chức năng</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $key =>$val)
                    <tr class="{{'item-'.$val->id}}">
                      <td>{{$key+1}}</td>
                      <td>{{$val->name}}</td>
                      <td>{{$val->address}}</td>
                      <td>{{$val->email}}</td>
                      <td>{{$val->phone}}</td>
                      <td>{{($val->is_active==1)?'Đã kích hoạt':'Chưa kích hoạt'}}</td>
                      <td>
                        <a href="{{route('admin.vendor.edit',['id'=>$val->id])}}" class="btn btn-primary">
                          <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a href="javascript:void(0)" onclick="destroyModel('vendor',{{$val->id}})">
                            <button class="btn btn-danger">
                            <i class="fa-solid fa-trash"></i>
                            </button>
                        </a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
@endsection