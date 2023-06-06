@extends('client.layouts.main')
@section('content')
                        <div class="breadcrumbs_area">
                            <div class="row">
               
                                    <div class="col-12">
                                        <div class="breadcrumb_content">
                                            <ul>
                                                <li><a href="{{route('home')}}">home</a></li>
                                                <li><i class="fa fa-angle-right"></i></li>
                                                <li>blog detail</li>
                                            </ul>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <!--breadcrumbs area end-->
                        <div class="main_blog_area blog_details">
                            <div class="row">
                                    <div class="col-lg-9 col-md-12">
                                        <div class="blog_details_left">
                                            <div class="blog_gallery">   
                                                <div class="blog_header">
                                                    <span>
                                                        <a href="#">WordPress</a>
                                                    </span>
                                                    <h2><a href="#">Post with Gallery</a></h2>
                                                    <div class="blog__post">
                                                        <ul>
                                                            <li class="post_author">Posts by : {{$data->user->name}}</li>
                                                            <li class="post_date"> {{$data->created_at}}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="blog_thumb" style="width: 830px">
                                                        <img src="{{asset($data->image)}}" alt="" width="100%">
                                                </div>
                                                <div class="blog_entry_content">
                                                   <p>{{$data->content}}</p>   
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
                                    <div class="col-lg-3 col-md-8 offset-md-2 offset-lg-0">
                                       <div class="blog_details_right">
                                       <div class="blog_widget widget_recent  mb-30">
                                               <h3>Recent Posts</h3> 
                                                <div class="widget_recent_inner">   
                                                    @foreach($related as $val)
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
                                            <div class="blog_widget widget_recent  mb-30">
                                               <h3>Popular</h3> 
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
                                    </div>
                                </div>
                        </div>
@endsection