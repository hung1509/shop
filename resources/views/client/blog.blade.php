@extends('client.layouts.main')
@section('content')
                        <div class="breadcrumbs_area">
                            <div class="row">
               
                                    <div class="col-12">
                                        <div class="breadcrumb_content">
                                            <ul>
                                                <li><a href="{{route('home')}}">home</a></li>
                                                <li><i class="fa fa-angle-right"></i></li>
                                                <li>blog</li>
                                            </ul>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <!--breadcrumbs area end-->
                        <div class="blog_area">
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
                        <div class="blog_pagination">
                            <div class="row">
                                <div class="col-12">
                                    <div class="page_number">
                                        <span>Pages: </span>
                                        {{$blog->links()}}
                                    </div>
                                </div>
                            </div>
                        </div>
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