@extends('admin.layouts.main')
@section('content')
<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h1 class="card-title">Danh sách người dùng</h1>

                <form class="card-tools" action="{{route('admin.member.index')}}">
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
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Tên người dùng</th>
                      <th>Email</th>
                      <th>Số điện thoại</th>
                      <th>Địa chỉ</th>
                      <th>Vai trò</th>
                      <th>Chức năng</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $key =>$val)
                    <tr class="{{'item-'.$val->id}}">
                      <td>{{$key+1}}</td>
                      <td>{{$val->name}}</td>
                      <td>{{$val->email}}</td>
                      <td>{{$val->phone}}</td>
                      <td>{{$val->address}}</td>
                      <td>{{($val->is_admin==1)?'ADMIN':'USER'}}</td>
                      <td>
                        <a href="javascript:void(0)" onclick="destroyModel('member',{{$val->id}})">
                            <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
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