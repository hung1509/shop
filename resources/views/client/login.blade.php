@extends('client.layouts.main')
@section('content')                      
                        <div class="breadcrumbs_area">
                            <div class="row">
                                    <div class="col-12">
                                        <div class="breadcrumb_content">
                                            <ul>
                                                <li><a href="{{route('home')}}">home</a></li>
                                                <li><i class="fa fa-angle-right"></i></li>
                                                <li>login</li>
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="customer_login">
                            <div class="row">
                                       <!--login area start-->
                                        <div class="col-lg-6 col-md-6">
                                            <div class="account_form">
                                                <h2>login</h2>
                                                <form action="{{route('postSignin')}}" method="post">
                                                    @csrf
                                                    <p>   
                                                        <label>Email<span>*</span></label>
                                                        <input type="email" name="email">
                                                     </p>
                                                     <p>   
                                                        <label>Password<span>*</span></label>
                                                        <input type="password" name="password">
                                                     </p>   
                                                    <div class="login_submit">
                                                        <button type="submit">login</button>
                                                        <label for="remember">
                                                            <input id="remember" type="checkbox">
                                                            Remember me
                                                        </label>
                                                        <a href="#">Lost your password?</a>
                                                    </div>

                                                </form>
                                             </div>    
                                        </div>
                                        <!--login area start-->

                                        <!--register area start-->
                                        <div class="col-lg-6 col-md-6">
                                            <div class="account_form register">
                                                <h2>Register</h2>
                                                <form action="{{route('signup')}}" method="post">
                                                    @csrf
                                                    <div class="row">   
                                                        <div class="col-6">
                                                            <label>Name <span>*</span></label>
                                                            <input type="text" name="name">
                                                        </div>
                                                        <div class="col-6">
                                                            <label>Password <span>*</span></label>
                                                            <input type="password" name="password">
                                                        </div>
                                                    </div>
                                                    <div style="margin-top: 10px; margin-bottom: 10px;">   
                                                        <label>Email<span>*</span></label>
                                                        <input type="email" name='email'>
                                                     </div>
                                                    <div class="login_submit">
                                                        <button type="submit">Register</button>
                                                    </div>
                                                </form>
                                            </div>    
                                        </div>
                                        <!--register area end-->
                                    </div>
                        </div>
@endsection