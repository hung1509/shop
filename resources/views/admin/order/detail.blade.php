@extends('admin.layouts.main')
@section('content')
    <div class="row">
    <div class="card col-12">
              <div class="card-header">
                <h3 class="card-title">Chi tiết đơn hàng</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="exampleInputEmail1">Tên người nhận</label>
                      <input type="text" name="phone" class="form-control" id="exampleInputEmail1" value="{{$order->name}}" disabled>
                    </div>
                    <div class="form-group col-6">
                      <label for="exampleInputEmail1">Số điện thoại</label>
                      <input type="text" name="email" class="form-control" id="exampleInputEmail1" value="{{$order->phone}}" disabled>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-6">
                        <label>Địa chỉ</label>
                        <div>
                          <textarea class="form-control" name="address" disabled>{{$order->address}}</textarea>
                        </div>
                    </div>
                      <div class="col-6">
                          <label>Ghi chú</label>
                          <div>
                            <textarea class="form-control" name="address" disabled>{{$order->note}}</textarea>
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                  <table class="table table-hover text-nowrap table-bordered">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Tên sản phẩm</th>
                      <th>Size</th>
                      <th>Số lượng</th>
                      <th>Giá</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($items as $key =>$val)
                    <tr class="{{'item-'.$val->id}}">
                      <td>{{$key+1}}</td>
                      <td>{{$val->product_name}}</td>
                      <td>{{$val->size}}</td>
                      <td>{{$val->quantity}}</td>
                      <td>{{ number_format($val->product_price*(100-$val->product_sale)/100 * $val->quantity,0, '', ',')}}VND</td>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="5" class="text-right">Tổng: {{number_format($order->total, 0, '', ',')}}VND</td>
                    </tr>
                  </tfoot>
                </table>
                  </div>
                  <div class="form-group col-3">
                    <label for="countru_name">Phương thức thanh toán:</label>
                    <input type="text" name="email" class="form-control" id="exampleInputEmail1" value="{{$order->payment_id}}" disabled>
                  </div>
                  <div class="form-group col-3">
                      <label for="exampleInputEmail1">Trạng thái</label>
                      <input type="text" name="email" class="form-control" id="exampleInputEmail1" value="{{$order->status}}" disabled>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <div class="row">
                        @if($order->status == 'Đã xác nhận')
                        <div class="order_button">
                            <a class="btn btn-danger" href="{{route('cancel',['id'=> $order->id])}}">Hủy</a> 
                        </div>
                        @endif
                    </div>
                </div>
              </form>
            </div>
    </div>
@endsection