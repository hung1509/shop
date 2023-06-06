@extends('client.layouts.main')
@section('content')
                        <div class="breadcrumbs_area">
                            <div class="row">
                                <div class="col-12">
                                    <div class="breadcrumb_content">
                                        <ul>
                                            <li><a href="{{route('home')}}">home</a></li>
                                            <li><i class="fa fa-angle-right"></i></li>
                                            <li>about us</li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="about_section">
                            <div class="row align-items-center">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="about_thumb">
                                            <img src="assets\img\ship\about1.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="about_content">
                                            <h1>Lorem uis autem vel eum iriure dolor<br>nulla facilisis at vero eros et accumsan </h1>
                                            <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam, est usus legentis in iis qui facit eorum claritatem. </p>
                                            <div class="view__work">
                                                <a href="{{route('shop')}}">view work </a>
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                        </div>
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