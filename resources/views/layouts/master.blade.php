<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield("title", "BikeShop | จำหน่ายอะไหล่จักรยานออนไลน์")</title>
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
                <!-- js -->
        <script src="{{ asset('js/angular.min.js') }}"></script>
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js" integrity="sha512-F636MAkMAhtTplahL9F6KmTfxTmYcAcjcCkyu0f0voT3N/6vzAuJ4Num55a0gEJ+hRLHhdz3vDvZpf6kqgEa5w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css" integrity="sha512-9tISBnhZjiw7MV4a1gbemtB9tmPcoJ7ahj8QWIc0daBCdvlKjEA48oLlo6zALYm3037tPYYulT0YQyJIJJoyMQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <body>
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ URL::to('home') }}">BikeShop</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="{{ URL::to('home') }}">หน้าแรก</a></li>@guest
                        @else
                        <li><a href="{{ URL::to('product') }}">จัดการข้อมูลสินค้า </a></li>
                        <li><a href="{{ URL::to('category') }}">ข้อมูลประเภทสินค้า</a></li>
                        <li><a href="/order">รายการสั่งซื้อ</a></li>
                        <li><a href="/customer">จัดการข้อมูลผู้ใช้</a></li>
                        <li><a href="/product">จัดการข้อมูลสินค้า</a></li>

                        @endguest
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="{{ URL::to('cart/view') }}"> <i class="fa fa-shopping-cart"></i>
                                 ตะกร้า
                            <span class="label label-danger">
                                       @if (Session::has('cart_items'))
                                            {{ count(Session::get('cart_items')) }}
                                       @else
                                            {{ count(array()) }}
                                      @endif
                            </span>
                            </a>
                            
                        </li>
                        @guest
                        <li><a href="{{ route('login') }}">ล็อกอิน</a></li>
                        <li><a href="{{ route('register') }}">ลงทะเบียน</a></li> @else
                        <li><a href="#">{{ Auth::user()->name }} </a></li>
                        <li><a href="{{URL::to('logout')}}">ออกจากระบบ </a></li> 
                        
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <br>

        <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    </body>@yield("content")
    @if(session('msg'))
        @if(session('ok'))
            <script>toastr.success("{{ session('msg') }}")</script>
        @else
            <script>toastr.error("{{ session('msg') }}")</script>
        @endif
    @endif
        

</html>