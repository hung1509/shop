                        <div class="header_area">
                               <!--header top--> 
                                <div class="header_top">
                                   <div class="row align-items-center">
                                        <div class="col-lg-6 col-md-6">
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="header_links">
                                                <ul>
                                                    <li><a href="{{route('contact')}}" title="Contact">Contact</a></li>
                                                    <li><a href="
                                                    @guest
                                                        {{route('signin')}}
                                                    @else
                                                        {{route('myAccount', ['id' => Auth::user()->id])}}                                                        
                                                    @endguest
                                                    " title="My account">My account</a></li>
                                                    @guest
                                                    <li><a href="{{route('signin')}}" title="My cart">Login</a></li>
                                                    @else
                                                        <li class="nav-item dropdown">
                                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                                {{ Auth::user()->name }} <span class="caret"></span>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                                onclick="event.preventDefault();
                                                                                document.getElementById('logout-form').submit();">
                                                                    {{ __('Logout') }}
                                                                </a>
                                                                <form id="logout-form" action="{{ route('signout') }}" method="POST" style="display: none;">
                                                                    @csrf
                                                                </form>
                                                            </div>
                                                        </li>
                                                    @endguest
                                                </ul>
                                            </div>   
                                        </div>
                                   </div> 
                                </div> 
                                <!--header top end-->

                                <!--header middel--> 
                                <div class="header_middel">
                                    <div class="row align-items-center">
                                       <!--logo start-->
                                        <div class="col-lg-3 col-md-3">
                                            <div class="logo">
                                                <a href="{{route('home')}}"><img src="assets\img\logo\logo.jpg.png" alt=""></a>
                                            </div>
                                        </div>
                                        <!--logo end-->
                                        <div class="col-lg-9 col-md-9">
                                            <div class="header_right_info">
                                                <div class="search_bar">
                                                    <form action="{{route('shop')}}">
                                                        <input placeholder="Search..." type="text" name='keysearch'>
                                                        <button type="submit"><i class="fa fa-search"></i></button>
                                                    </form>
                                                </div>
                                                <div class="shopping-cart">
                                                    @include('client.layouts.shoppingCart')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>     
                                <!--header middel end-->      
                            <div class="header_bottom">
                                <div class="row">
                                        <div class="col-12">
                                            <div class="main_menu_inner">
                                                <div class="main_menu d-none d-lg-block">
                                                    <nav>
                                                        <ul>
                                                            <li><a href="{{route('home')}}">Home</a></li>
                                                            <li><a href="{{route('about')}}">About Us</a>
                                                            <li><a href="{{route('shop')}}">Shop</a>
                                                            </li>
                                                            <li><a href="{{route('blog')}}">Blog</a>
                                                            </li>
                                                            <li><a href="{{route('contact')}}">Contact us</a></li>

                                                        </ul>
                                                    </nav>
                                                </div>
                                                <div class="mobile-menu d-lg-none">
                                                    <nav>
                                                        <ul>
                                                            <li><a href="{{route('home')}}">Home</a></li>
                                                            <li><a href="{{route('about')}}">About Us</a>
                                                            <li><a href="{{route('shop')}}">Shop</a>
                                                            </li>
                                                            <li><a href="{{route('blog')}}">Blog</a>
                                                            </li>
                                                            <li><a href="{{route('contact')}}">Contact us</a></li>

                                                        </ul>
                                                    </nav>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>