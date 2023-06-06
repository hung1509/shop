<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Coron - Fashion eCommerce Bootstrap4 Template</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="\assets\img\favicon.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;1,100;1,200;1,300;1,400&display=swap" rel="stylesheet">
		
		<!-- all css here -->
        <link rel='stylesheet' href='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css'>
       <link rel="stylesheet" href="\assets\css\bootstrap.min.css">
        <link rel="stylesheet" href="\assets\css\plugin.css">
        <link rel="stylesheet" href="\assets\css\bundle.css">
        <link rel="stylesheet" href="\assets\css\style.css">
        <link rel="stylesheet" href="\assets\css\responsive.css">
        <!-- <script src="sweetalert2.all.min.js"></script>
        <script src="\assets\js\vendor\modernizr-2.8.3.min.js"></script>
        <script src="sweetalert2.min.js"></script> -->
        <link rel="stylesheet" href="sweetalert2.min.css">
    </head>
    <body>
            <!-- Add your site or application content here -->
            
            <!--pos page start-->
            <div class="pos_page">
                <div class="container">
                   <!--pos page inner-->
                    <div class="pos_page_inner">  
                        @include('client.layouts.header')
                        <div class="pos_home_section">
                               @yield('content')         
                        </div>
                    </div>
                    <!--pos page inner end-->
                </div>
            </div>
            <!--pos page end-->
            @include('client.layouts.footer')
		<!-- all js here -->
        <script src="\assets\js\vendor\jquery-1.12.0.min.js"></script>
        <script src="\assets\js\popper.js"></script>
        <script src="\assets\js\bootstrap.min.js"></script>
        <script src="\assets\js\ajax-mail.js"></script>
        <script src="\assets\js\plugins.js"></script>
        <script src="\assets\js\main.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js'></script>
        <script>
            // add to cart
            $(function(){
                $('.add-to-cart').on('click', function(event){
                    event.preventDefault();
                    let urlCart = $(this).data('url');
                    let quantity = $(this).parents('form').find('input').val();
                    let size = $(this).parents('.product_d_right').find('select').val();
                    $.ajax({
                        type: 'GET',
                        url : urlCart,
                        dataType: 'json',
                        data: {quantity: quantity, size: size},
                        success: function(data){
                            if(data.code == 200){
                                $('.shopping-cart').html(data.cart_component);
                                const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                                })

                                Toast.fire({
                                icon: 'success',
                                title: 'Thêm vào giỏ hàng thành công'
                                })
                            }
                        },
                        error: function(){

                        },
                    })
                });
            })
            // remove from cart
            $(function(){
                $('.remove-item').on('click', function(e){
                    e.preventDefault();
                    let urlRemove = $(this).data('url');
                    let id = $(this).data('id');
                    $.ajax({
                        type: 'GET',
                        url : urlRemove,
                        dataType : 'json',
                        data: {id: id},
                        success : function(data){
                            if(data.code == 200){
                                $('.shopping-cart').html(data.cart_component);
                            }
                        }
                    })
                })
            })
            // update
            $(function(){
                $('.updateCart').on('click', function(e){
                    e.preventDefault();
                    let urlUpdate = $(this).data('url');
                    let quantity = $(this).parents('tr').find('.qtyItem').val();
                    $.ajax({
                        type : 'GET',
                        url : urlUpdate,
                        dataType : 'json',
                        data: {quantity: quantity},
                        success : function(data){
                            if(data.code == 200){
                                $('.shopping-cart').html(data.cart_component);
                                const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                                })

                                Toast.fire({
                                icon: 'success',
                                title: 'Cập nhật giỏ hàng thành công'
                                })
                            }
                        }
                    })
                })
            })
            $(function(){
                $('.remove-cart').on('click', function(e){
                    let result = confirm('Bạn có chắc muốn xóa hết?');
                    if(result){
                        e.preventDefault();
                        let urlRemoveCart = $(this).data('url');
                        $.ajax({
                            type : 'GET',
                            url : urlRemoveCart,
                            dataType : 'json',
                            success : function(data){
                                if(data.code == 200){
                                    $('.shopping-cart').html(data.cart_component);
                                }
                            }
                        })
                    }
                })
            })
        </script>
    </body>
</html>
