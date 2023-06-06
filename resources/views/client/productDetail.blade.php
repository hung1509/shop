@extends('client.layouts.main')
@section('content')
                        <div class="breadcrumbs_area">
                            <div class="row">
                                <div class="col-12">
                                    <div class="breadcrumb_content">
                                        <ul>
                                            <li><a href="{{route('home')}}">home</a></li>
                                            <li><i class="fa fa-angle-right"></i></li>
                                            <li>product detail</li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product_details">
                            <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="product_tab fix d-flex"> 
                                            <div class="product_tab_button ">    
                                                <ul class="nav d-flex flex-colunm justify-content-between" role="tablist">
                                                    <li class="p-0">
                                                        <a class="active" data-toggle="tab" href="#p_tab" role="tab" aria-controls="p_tab" aria-selected="true"><img src="{{asset($data->image)}}" alt=""></a>
                                                    </li>
                                                    @foreach($images as $key => $val)
                                                    <li class='p-0'>
                                                         <a data-toggle="tab" href="#p_tab{{$key}}" role="tab" aria-controls="p_tab{{$key}}" aria-selected="false"><img src="{{asset($val->image)}}" alt=""></a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div> 
                                            <div class="tab-content produc_tab_c w-100">
                                                <div class="tab-pane fade show active" id="p_tab" role="tabpanel">
                                                    <div class="modal_img">
                                                        <img src="{{asset($data->image)}}" alt="">
                                                        <div class="view_img">
                                                            <a class="large_view" href="{{asset($data->image)}}"><i class="fa fa-search-plus"></i></a>
                                                        </div>    
                                                    </div>
                                                </div>
                                                @foreach($images as $key => $val)
                                                <div class="tab-pane fade" id="p_tab{{$key}}" role="tabpanel">
                                                    <div class="modal_img">
                                                        <img src="{{asset($val->image)}}" alt="">
                                                        <div class="view_img">
                                                            <a class="large_view" href="{{asset($val->image)}}"><i class="fa fa-search-plus"></i></a>
                                                        </div>    
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>

                                        </div> 
                                    </div>
                                    <div class="col-lg-7 col-md-6">
                                        <div class="product_d_right">
                                            <h1>{{$data->name}}</h1>

                                            <div class="product_desc">
                                                <p>{{$data->description}}</p>
                                            </div>

                                            <div class="content_price mb-15">
                                                        @if($data->sale)
                                                            <span class="product_price"><del class="text-danger me-1">{{number_format($data->price, 0, '', ',')}}</del>{{number_format($data->price * (100 - $data->sale) / 100, 0, '', ',')}}VND</span>
                                                        @else
                                                            <span class="product_price">{{number_format($data->price, 0, '', ',')}}VND</span>
                                                        @endif
                                            </div>
                                            <div class="box_quantity mb-20">
                                                <form>
                                                    <label>Quantity</label>
                                                    <input min="1" max="100" value="1" type="number">
                                                    <a class="add-to-cart" data-url="{{route('addToCart', ['id'=>$data->id])}}"><i class="fa fa-shopping-cart"></i> add to cart</a>
                                                </form> 
                                            </div>
                                            <div class="product_d_size mb-20">
                                                <label for="group_1">size</label>
                                                <select name="size" class="size" id="group_1">
                                                    @foreach($sizes as $size)
                                                        <option value="{{$size->name}}">{{$size->name}}</option>
                                                    @endforeach
                                                </select>
                                
                                            </div>               

                                            <div class="product_stock mb-20">
                                               <p>{{$data->quantity}} items</p>
                                            </div>
                                            <div class="wishlist-share">
                                                <h4>Share on:</h4>
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-rss"></i></a></li>           
                                                    <li><a href="#"><i class="fa fa-vimeo"></i></a></li>           
                                                    <li><a href="#"><i class="fa fa-tumblr"></i></a></li>           
                                                    <li><a href="#"><i class="fa fa-pinterest"></i></a></li>        
                                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>        
                                                </ul>      
                                            </div>

                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="product_d_info">
                            <div class="row">
                                <div class="col-12">
                                    <div class="product_d_inner">   
                                        <div class="product_info_button">    
                                            <ul class="nav" role="tablist">
                                                <li>
                                                    <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">More info</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="info" role="tabpanel">
                                                <div class="product_info_content">
                                                    <table class="table mb-0 table-bordered">
                                                            <tbody>
                                                                <tr>
                                                                    <th class="first_child">Danh mục</th>
                                                                    <td>{{$category->name}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="first_child">Nhãn hàng</th>
                                                                    <td>{{$brand->name}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="first_child">Nhà cung cấp</th>
                                                                    <td>{{$vendor->name}}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                </div>    
                                            </div>
                                        </div>
                                    </div>     
                                </div>
                            </div>
                        </div>
                        <div class="new_product_area product_two">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="block_title">
                                        <h3>RELATED PRODUCTS</h3>
                                    </div>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="single_p_active owl-carousel">
                                    @foreach($relatedProducts as $val)
                                        <div class="col-lg-3">
                                                <div class="single_product">
                                                    <div class="product_thumb">
                                                    <a href="{{route('shop.detail', ['id' => $val->id])}}"><img src="{{asset($val->image)}}" alt="{{$val->name}}" height="330px"></a> 
                                                    @if($val->sale)
                                                    <div class="img_icone">
                                                        <p>-{{$val->sale}}%</p>
                                                    </div>
                                                    @endif
                                                    @if($val->hot==1)
                                                    <div class="hot_img">
                                                       <p>HOT</p>
                                                   </div>
                                                    @endif
                                                    </div>
                                                    <div class="product_content">
                                                        @if($val->sale)
                                                            <span class="product_price"><del class="text-danger me-1">{{number_format($val->price, 0, '', ',')}}</del>{{number_format($val->price * (100 - $val->sale) / 100, 0, '', ',')}}VND</span>
                                                        @else
                                                            <span class="product_price">{{number_format($val->price, 0, '', ',')}}VND</span>
                                                        @endif
                                                        <h3 class="product_title"><a href="{{route('shop.detail', ['id' => $val->id])}}">{{$val->name}}</a></h3>
                                                    </div>
                                                    <div class="product_info">
                                                        <ul>
                                                            <li><a href="{{route('shop.detail', ['id' => $val->id])}}" title="Quick view">View Detail</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                    </div> 
                                </div>      
                            </div>
        @endsection