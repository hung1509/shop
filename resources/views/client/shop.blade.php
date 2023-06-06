@extends('client.layouts.main')
@section('content')
                        <div class="breadcrumbs_area">
                            <div class="row">
               
                                    <div class="col-12">
                                        <div class="breadcrumb_content">
                                            <ul>
                                                <li><a href="{{route('home')}}">home</a></li>
                                                <li><i class="fa fa-angle-right"></i></li>
                                                <li>shop</li>
                                            </ul>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <!--breadcrumbs area end-->


                        <!--pos home section-->
                        <div class=" pos_home_section">
                            <div class="row pos_home">
                                    <div class="col-lg-3 col-md-12">
                                        <div class="sidebar_widget shop_c">
                                                <div class="categorie__titile">
                                                    <h4 class="ff-san">Danh mục sản phẩm</h4>
                                                </div>
                                                <div class="layere_categorie">
                                                    <ul>
                                                        @foreach($category as $val)
                                                        <li>
                                                            {{$val->name}}
                                                            <ul>
                                                                @foreach($val->children as $child)
                                                                    <a href="{{route('shop', ['keysearch'=>$child->name])}}">
                                                                        <li class="px-3">{{$child->name}}</li>
                                                                    </a>
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="blog_widget widget_recent  mb-30">
                                               <h4 class="ff-san">Tin tức nổi bật</h4> 
                                                <div class="widget_recent_inner">   
                                                @foreach($hot as $val)
                                                   <div class="single_posts">
                                                        <div class="posts_thumb">
                                                            <a href="{{route('blog.detail', ['id'=>$val->id])}}"><img src="{{asset($val->image)}}" alt=""></a>
                                                        </div>
                                                        <div class="post_content">
                                                            <span>
                                                                <a class="tweet_author" href="{{route('blog.detail', ['id'=>$val->id])}}">{{$val->title}}</a>

                                                            </span>
                                                            <a href="{{route('blog.detail', ['id'=>$val->id])}}">{{$val->created_at}}</a>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>         
                                            </div>
                                    </div>
                                    <div class="col-lg-9 col-md-12">
                                        <!--shop toolbar start-->
                                        <div class="shop_toolbar mb-35">                         
                                            <div class="select_option">
                                                <form action="{{route('shop')}}">
                                                    <select name="orderby" id="short">
                                                        <option selected="" value="">Position</option>
                                                        <option value="1" {{($orderby && $orderby == 1)?'selected':''}}>Price: Lowest</option>
                                                        <option value="2" {{($orderby && $orderby == 2)?'selected':''}}>Price: Highest</option>
                                                        <option value="3" {{($orderby && $orderby == 3)?'selected':''}}>Product Name: Z</option>
                                                        <option value="4" {{($orderby && $orderby == 4)?'selected':''}}>Product Name: A</option>
                                                    </select>
                                                    <button type="submit" class="btn btn-pimary">Lọc</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!--shop toolbar end-->

                                        <!--shop tab product-->
                                        <div class="shop_tab_product">  
                                            @if($keySearch)
                                            <h4>Tìm kiếm: <span class="text-danger">{{$keySearch}}</span></h4>
                                            @endif
                                                    <div class="row">
                                                    @if($data && count($data) > 0)
                                                        @foreach($data as $val)
                                                        <div class="col-lg-4 col-md-6">
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
                                                    @else 
                                                        <h5 class="mt-4 w-100 text-center">Không tìm thấy kết quả</h5>
                                                    @endif
                                                    </div>  
                                        </div>    
                                        <!--shop tab product end-->

                                        <!--pagination style start--> 
                                        @if($data && count($data) > 0)
                                        <div class="pagination_style">
                                            <div class="page_number">
                                                <span>Pages: </span>
                                                {{$data->links()}}
                                            </div>
                                        </div>
                                        @endif
                                        <!--pagination style end--> 
                                    </div>
                                </div>  
                        </div>                            
@endsection
