@extends('client.layouts.main')
@section('content')
                            <div class="row">
                               <!--banner slider start-->
                                <div class="col-12">
                                    <div class="banner_slider slider_two">
                                        <div class="slider_active owl-carousel">
                                            @foreach($banner as $val)
                                            <div class="single_slider" style="width: 1170px; height: 555px; background-image: url('{{$val->image}}')">
                                                 <div class="slider_content">
                                                    <div class="slider_content_inner">  
                                                        <h1>{{$val->title}}</h1>
                                                        <p>{{$val->description}}</p>
                                                        <a href="{{route('shop')}}">shop now</a>
                                                    </div>     
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div> 
                                    <!--banner slider start-->
                                </div>    
                            </div>  
                             <!--new product area start-->
                            <div class="new_product_area product_two">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="block_title">
                                        <h3>New Products</h3>
                                    </div>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="single_p_active owl-carousel">
                                    @foreach($newProduct as $val)
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
                                                            <li><a href="{{route('shop.detail', ['id' => $val->id])}}">View Detail</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div> 
                                </div>      
                            </div> 
                            <!--new product area start--> 
                            <!--featured product area start-->
                            <div class="new_product_area product_two">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="block_title">
                                        <h3>   featured Products</h3>
                                    </div>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="single_p_active owl-carousel">
                                    @foreach($hotProduct as $val)
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
                            <!--featured product area start-->   
                                   
                            <!--blog area start-->
                            <div class="blog_area blog_two">
                                <div class="row">   
                                    @foreach($blog as $val)
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single_blog">
                                            <div class="blog_thumb">
                                                <a href="{{route('blog.detail', ['id' => $val->id])}}"><img src="{{asset($val->image)}}" alt="" height="240px"></a>
                                            </div>
                                            <div class="blog_content">
                                                <h3><a href="{{route('blog.detail', ['id' => $val->id])}}">{{$val->title}}</a></h3>
                                                <p class="d-block" style="height: 72px; overflow: hidden;">{{$val->content}}</p>
                                                <div class="post_footer">
                                                    <div class="post_meta d-flex justify-content-end">
                                                        <ul>
                                                            <li>{{$val->created_at}}</li>
                                                        </ul>
                                                    </div>
                                                    <div class="Read_more">
                                                        <a href="{{route('blog.detail', ['id' => $val->id])}}">Read more  <i class="fa fa-angle-double-right"></i></a>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>    
                            </div>
                            <!--blog area end-->  
                                   
                            <!--brand logo strat--> 
                            <div class="brand_logo brand_two">
                                <div class="block_title">
                                    <h3>Brands</h3>
                                </div>
                                <div class="row">
                                    <div class="brand_active owl-carousel">
                                        @foreach($brand as $val)
                                            <div class="col-lg-2 d-flex" style="height: 120px;">
                                                <div class="single_brand">
                                                    <a href="{{$val->website}}"><img src="{{asset($val->image)}}" alt="{{$val->name}}" width="100%" height="100%"></a>
                                                </div>
                                            </div>
                                        @endforeach
                                        
                                    </div>
                                </div>
                            </div> 
                           
@endsection
