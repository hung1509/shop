@extends('client.layouts.main')
@section('content')                        <div class="breadcrumbs_area">
                            <div class="row">
                                <div class="col-12">
                                    <div class="breadcrumb_content">
                                        <ul>
                                            <li><a href="{{route('home')}}">home</a></li>
                                            <li><i class="fa fa-angle-right"></i></li>
                                            <li>order detail</li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Checkout_section">
                            <form action="" method="post" enctype="multipart/form-data">
                                @csrf
                            <div class="checkout_form">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                                <h3>Billing Details</h3>
                                                <div class="row">

                                                    <div class="col-lg-6 mb-30">
                                                        <label>Name <span>*</span></label>
                                                        <input type="text" name="name" value="{{$order->name}}" disabled>    
                                                    </div>
                                                    <div class="col-lg-6 mb-30">
                                                        <label>Phone  <span>*</span></label>
                                                        <input type="text" name="phone" value="{{$order->phone}}" disabled> 
                                                    </div>
                                                    <div class="col-12 mb-30">
                                                        <label>Address  <span>*</span></label>
                                                        <input name="address" type="text" value="{{$order->address}}" disabled>     
                                                    </div>
                                                    <div class="col-4 mb-30">
                                                        <label>Trạng thái</label>
                                                        <input name="" type="text" value="{{$order->status}}" disabled>     
                                                    </div>
                                                    <div class="col-12 mb-30">
                                                        <label>Note</label>
                                                        <textarea name="note" style="height : 140px;" disabled>
                                                        {{$order->note}}
                                                        </textarea>     
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                                <h3>Your order</h3> 
                                                <div class="order_table table-responsive mb-30">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th>Product</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($items as $val)
                                                            <tr>
                                                                <td> {{$val->product_name}} ({{$val->size}}) <strong> × {{$val->quantity}}</strong></td>
                                                                <td> {{ number_format($val->product_price*(100-$val->product_sale)/100 * $val->quantity,0, '', ',')}}VND</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr class="order_total">
                                                                <th>Order Total</th>
                                                                <td><strong>{{number_format($order->total, 0, '', ',')}}VND</strong></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>     
                                                </div>
                                                <div class="payment_method">
                                                        <div class="select_form_select">
                                                            <label for="countru_name">Payment:<span>*</span></label>
                                                                <select name="payment" id="countru_name" style="display: none;" disabled>    
                                                                    <option value="Thanh toán khi nhận hàng">{{$order->payment_id}}</option>   
                                                                </select>
                                                       </div>  
                                                </div> 
                                        </div>
                                    </div> 
                                    <div class="row">
                                        @if($order->status == 'Đã xác nhận')
                                        <div class="order_button">
                                            <a class="btn btn-success" href="{{route('confirm',['id'=> $order->id])}}">Xác nhận</a> 
                                        </div>
                                        <div class="order_button">
                                            <a class="btn btn-danger" href="{{route('cancel',['id'=> $order->id])}}">Hủy</a> 
                                        </div>
                                        @else 
                                        <div class="order_button">
                                            <a class="btn btn-success" href="{{route('back')}}">Back</a> 
                                        </div>
                                        @endif
                                    </div>
                                </div> 
                                </form>       
                        </div>
@endsection