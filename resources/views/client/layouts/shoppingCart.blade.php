<div class="shopping_cart d-flex align-items-center">
@php 
    $cart = session()->get('cart');
@endphp
    <a class="btn viewCart" data-toggle="modal" data-target="#cartModal">
        <i class="fa fa-shopping-cart"></i>
        @if($cart)
            {{count($cart)}} - Items
        @else
            0 - Item
        @endif
    </a>
</div>
<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">                              
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">
                    Shopping Cart
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body d-flex justify-content-center">
                                                @php
                                                    $total = 0
                                                @endphp
                                                @if(isset($cart) && count($cart) > 0)
                                            <table class="table-bordered table cart-table">
                                                <thead>
                                                    <tr>
                                                        <th class="product_thumb">Image</th>
                                                        <th class="product_name">Product</th>
                                                        <th class="product_name">Size</th>
                                                        <th class="product-price">Price</th>
                                                        <th class="product_quantity">Quantity</th>
                                                        <th class="product_total">Total</th>
                                                        <th class="product_remove">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="cart-body">
                                                    @foreach($cart as $key => $val)
                                                    @php 
                                                        $total += $val['price']*(100-$val['sale'])/100*$val['quantity']
                                                    @endphp
                                                    <tr class="cart-items">
                                                        <td class="product_thumb"><a href="{{route('shop.detail', ['id' => $key])}}"><img src="{{asset($val['image'])}}" alt="" width="80px" height="100px"></a></td>
                                                        <td class="product_name"><a href="{{route('shop.detail', ['id' => $key])}}">{{$val['name']}}</a></td>
                                                        <td class="product_name">{{$val['size']}}</td>
                                                        <td class="product-price">
                                                            @if($val['sale'])
                                                            <del class="text-danger me-1">{{number_format($val['price'], 0, '', ',')}}</del>{{number_format($val['price'] * (100 - $val['sale']) / 100, 0, '', ',')}}VND
                                                            @else
                                                            <span class="cart_price">{{number_format($val['price'], 0, '', ',')}}VND</span>
                                                            @endif
                                                        </td>
                                                        <td class="product_quantity"><input class="qtyItem" min="1" max="100" value="{{$val['quantity']}}" type="number"></td>
                                                        <td class="product_total">
                                                            {{ number_format($val['price']*(100-$val['sale'])/100 * $val['quantity'],0, '', ',')}}VND
                                                        </td>
                                                        <td class="product_remove">
                                                            <a href="javascript:void(0)" class="updateCart" title="update" data-url="{{route('updateCart', ['id' => $key])}}"><i class="fa fa-floppy-o"></i></a>
                                                            <a href="javascript:void(0)" class="remove-item" title="remove" data-url="{{route('removeFormCart', ['id' => $key])}}"><i class="fa fa-trash-o"></i></a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="7"><h4 class="text-right">Total: <span>{{number_format($total, 0, '', ',')}}</span> VND</h4></td>
                                                    </tr>
                                                @else
                                                    <img src="https://bizweb.dktcdn.net/100/361/875/themes/729886/assets/empty-cart.png?1664761752297" width="50%"/>
                                                @endif
                                                </tbody>
                                            </table>   
                                        </div>  
                                            @if(isset($cart) && count($cart) > 0)
                                                <div class="modal-footer border-top-0 d-flex justify-content-between">
                                                  <a class="btn btn-secondary remove-cart" data-url="{{route('removeCart')}}">Remove all</a>
                                                  <a class="btn btn-success" 
                                                    href="
                                                    @guest
                                                        {{route('signin')}}
                                                    @else
                                                        {{route('checkout')}}
                                                    @endguest"
                                                  >Checkout</a>
                                                </div>
                                            @endif    
                </div>
            </div>
</div>