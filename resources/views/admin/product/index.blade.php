@extends('admin.layouts.main')
@section('content')
<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h1 class="card-title">Danh sách sản phẩm</h1>

                <form class="card-tools" action="{{route('admin.product.index')}}">
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
              <a href="{{route('admin.product.create')}}" style="width: 180px;" class="btn btn-primary my-4 mx-3">Thêm sản phẩm</a>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Tên sản phẩm</th>
                      <th>Ảnh</th>
                      <th>Danh mục</th>
                      <th>Giá</th>
                      <th>Giảm giá</th>
                      <th>Số lượng</th>
                      <th>Trạng thái</th>
                      <th>Chức năng</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $key =>$val)
                    <tr class="{{'item-'.$val->id}}">
                      <td>{{$key+1}}</td>
                      <td>{{$val->name}}</td>
                      <td><img src="{{asset($val->image)}}" alt="ảnh" width="50px" height="80px"></td>
                      <td>{{$val->category_name}}</td>
                      <td>{{$val->price}}</td>
                      <td>{{($val->sale)?$val->sale:'0'}}%</td>
                      <td>{{$val->quantity}}</td>
                      <td>{{($val->is_active == 1)?'Đã kích hoạt':'Chưa kích hoạt'}}</td>
                      <td>
                        <a href="{{route('admin.product.edit',['id'=>$val->id])}}" class="btn btn-primary">
                          <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a href="javascript:void(0)" onclick="destroyModel('product',{{$val->id}})">
                            <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                        </a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              {{$data->links()}}
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
@endsection