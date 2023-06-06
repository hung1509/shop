@extends('client.layouts.main')
@section('content')
                        <div class="breadcrumbs_area">
                            <div class="row">
                                <div class="col-12">
                                    <div class="breadcrumb_content">
                                        <ul>
                                            <li><a href="{{route('home')}}">home</a></li>
                                            <li><i class="fa fa-angle-right"></i></li>
                                            <li>checkout</li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Checkout_section">
                            <form action="{{route('admin.order.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                            <div class="checkout_form">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                                <h3>Billing Details</h3>
                                                <div class="row">

                                                    <div class="col-lg-6 mb-30">
                                                        <label>Name <span>*</span></label>
                                                        <input type="text" name="name" value="{{Auth::user()->name}}">    
                                                    </div>
                                                    <div class="col-lg-6 mb-30">
                                                        <label>Phone  <span>*</span></label>
                                                        <input type="text" name="phone" value="{{Auth::user()->phone}}"> 
                                                    </div>
                                                    <div class="col-12 mb-30">
                                                        <label>Address  <span>*</span></label>
                                                        <input name="address" type="text" value="{{Auth::user()->address}}">     
                                                    </div>
                                                    <div class="col-12 mb-30">
                                                        <label>Note</label>
                                                        <textarea name="note" style="height : 140px;"></textarea>     
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
                                                            @php 
                                                                $cart = session()->get('cart');
                                                                $total = 0;
                                                            @endphp
                                                            @foreach($cart as $val)
                                                                @php 
                                                                    $total += $val['price']*(100-$val['sale'])/100*$val['quantity']
                                                                @endphp
                                                            <tr>
                                                                <td> {{$val['name']}} ({{$val['size']}})<strong> × {{$val['quantity']}}</strong></td>
                                                                <td> {{ number_format($val['price']*(100-$val['sale'])/100 * $val['quantity'],0, '', ',')}}VND</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr class="order_total">
                                                                <input type="number" value="{{$total}}" name="total" style="display: none">
                                                                <th>Order Total</th>
                                                                <td><strong>{{number_format($total, 0, '', ',')}}VND</strong></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>     
                                                </div>
                                                <div class="payment_method">
                                                        <div class="select_form_select">
                                                            <label for="countru_name">Payment:<span>*</span></label>
                                                                <select name="payment" id="countru_name" style="display: none;">    
                                                                    <option value="Thanh toán khi nhận hàng">Thanh toán khi nhận hàng</option>   
                                                                </select>
                                                       </div>  
                                                </div> 
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="order_button">
                                            <button type="submit">Order</button> 
                                        </div>
                                    </div>
                                </div> 
                                </form>       
                        </div>
@endsection