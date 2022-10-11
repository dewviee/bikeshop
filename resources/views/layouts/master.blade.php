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
                        <li><a href="#">รายงาน</a></li>@endguest
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
                        <li><a href="#">ออกจากระบบ </a></li> @endguest
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