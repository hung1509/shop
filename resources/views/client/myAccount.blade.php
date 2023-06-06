@extends('client.layouts.main')
@section('content')
                        <div class="breadcrumbs_area">
                            <div class="row">
                                <div class="col-12">
                                    <div class="breadcrumb_content">
                                        <ul>
                                            <li><a href="{{route('home')}}">home</a></li>
                                            <li><i class="fa fa-angle-right"></i></li>
                                            <li>my account</li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <section class="main_content_area">
                                <div class="account_dashboard">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-3 col-lg-3">
                                            <!-- Nav tabs -->
                                            <div class="dashboard_tab_button">
                                                <ul role="tablist" class="nav flex-column dashboard-list">
                                                    <li> <a href="#orders" data-toggle="tab" class="nav-link active">Orders</a></li>
                                                    <li><a href="#account-details" data-toggle="tab" class="nav-link ">Account details</a></li>
                                                    <li>
                                                        <a class="nav-link" href="{{ route('logout') }}"
                                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                            Logout
                                                        </a>
                                                        <form id="logout-form" action="{{ route('signout') }}" method="POST" style="display: none;">
                                                            @csrf
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>    
                                        </div>
                                        <div class="col-sm-12 col-md-9 col-lg-9">
                                            <!-- Tab panes -->
                                            <div class="tab-content dashboard_content">
                                                <div class="tab-pane fade  active show" id="orders">
                                                    <h3>Orders</h3>
                                                    <div class="coron_table table-responsive text-center">
                                                        @if($order && count($order)>0)
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Order</th>
                                                                    <th>Date</th>
                                                                    <th>Status</th>
                                                                    <th>Total</th>
                                                                    <th>Actions</th>	 	 	 	
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($order as $key => $val)
                                                                <tr class="order-{{$val->id}}">
                                                                    <td>{{$key+1}}</td>
                                                                    <td>
                                                                        <a href="{{route('orderDetail', ['id'=>$val->id])}}">
                                                                        {{$val->created_at}}
                                                                        </a>
                                                                    </td> 
                                                                    @if($val->status == 'Đã xác nhận')
                                                                    <td><span class="success status text-warning">{{$val->status}}</span></td>
                                                                    @elseif($val->status == 'Đã hủy')
                                                                    <td><span class="success status text-danger">{{$val->status}}</span></td>
                                                                    @else
                                                                    <td><span class="success status text-success">{{$val->status}}</span></td>
                                                                    @endif
                                                                    <td>{{number_format($val->total, 0, '', ',')}}VND</td>
                                                                    <td>
                                                                    @if($val->status == 'Đã xác nhận')
                                                                        <a href="{{route('confirm',['id'=> $val->id])}}" class="btn btn-primary text-w">Xác nhận</a>
                                                                        <a href="{{route('cancel',['id'=> $val->id])}}" class="btn btn-danger text-w">Hủy</a>
                                                                    @else
                                                                        <a href="{{route('orderDetail', ['id'=>$val->id])}}" class="btn btn-primary text-w">Chi tiết</a>
                                                                    @endif
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                        @else
                                                            <img src="https://cdn.dribbble.com/users/357929/screenshots/2276751/media/678caef6068a976e4a0d94bbdba6b660.png?compress=1&resize=400x300&vertical=top"/>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="account-details">
                                                    <h3>Account details </h3>
                                                    <div class="login">
                                                        <div class="login_form_container">
                                                            <div class="account_login_form">
                                                                <form action="{{route('updateAcc')}}">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <label>Full Name</label>
                                                                    <input type="text" name="name" value="{{$user->name}}">
                                                                    <label>Phone</label>
                                                                    <input type="text" name="phone" value="{{$user->phone}}">
                                                                    <label>Email</label>
                                                                    <input type="text" name="Email" disabled value="{{$user->email}}">
                                                                    <label>Address</label>
                                                                    <input type="text" name="address" value="{{$user->address}}">
                                                                    <button type="submit" class="btn btn-success">
                                                                        Save
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>      	
                        </section>

@endsection