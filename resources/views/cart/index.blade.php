@extends("layouts.master") @section('title') BikeShop | ตะกร้าสินค้า @stop
@section('content')
<div class="container">
<h1>สินค้าในตะกร้า</h1>
<div class="breadcrumb">
<li><a href="{{ URL::to('home') }}"><i class="fa fa-home"></i> หน้าร้าน</a></li>
<li class="active">สินค้าในตะกร้า</li>
</div>
</div>
@endsection