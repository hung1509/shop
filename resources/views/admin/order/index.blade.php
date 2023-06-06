@extends('admin.layouts.main')
@section('content')
<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h1 class="card-title">Danh sách đơn hàng</h1>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Tên người nhận</th>
                      <th>Số điện thoại</th>
                      <th>Tổng tiền</th>
                      <th>Trạng thái</th>
                      <th>Chức năng</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $key =>$val)
                    <tr class="{{'item-'.$val->id}}">
                      <td>{{$key+1}}</td>
                      <td>{{$val->name}}</td>
                      <td>{{($val->phone)}}</td>
                      <td>{{number_format($val->total, 0, '', ',')}}VND</td>
                    @if($val->status == 'Đã xác nhận')
                        <td><span class="success status text-warning">{{$val->status}}</span></td>
                    @elseif($val->status == 'Đã hủy')
                        <td><span class="success status text-danger">{{$val->status}}</span></td>
                    @else
                        <td><span class="success status text-success">{{$val->status}}</span></td>
                    @endif
                      <td>
                          @if($val->status != 'Đã hủy')
                          <a href="{{route('cancel',['id'=> $val->id])}}">
                              <button class="btn btn-danger">
                              Hủy
                              </button>
                          </a>
                          @else
                          <a href="javascript:void(0)" onclick="destroyModel('order',{{$val->id}})">
                            <button class="btn btn-danger">
                                Xóa
                            </button>
                          </a>
                          @endif
                        <a href="{{route('admin.order.show',['id'=>$val->id])}}" class="btn btn-primary">
                          Chi tiết
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