@extends('layouts.master')

@section('title') BikeShop | การสั่งซื้อสำเร็จแล้ว @endsection
@section('content')

<div class="container">
    <h1>สั่งซื้อสำเร็จแล้ว</h1>

    <div class="breadcrumb">
        <li><a href="{{ URL::to('home') }}"><i class="fa fa-home"></i> หน้าร้าน</a></li>
        <li class="active">การสั่งซื้อสำเร็จแล้ว</li>
    </div>

    <div class="row">
        สั่งซื้อสำเร็จแล้ว<br>
        หมายเลขการสั่งซื้อของคุณคือ: {{$order_ref}}
    </div>

    <a href="{{ URL::to('home') }}" class="btn btn-default">กลับสู้หน้าหลัก </a>
    <div class="pull-right">
        <a id="print_receipt" href="#" class="btn btn-warning">พิมพ์ใบสั่งซื้อ</a>
    </div>

</div>

@endsection



<script>
    setTimeout(() => {

        document.querySelector('#print_receipt').addEventListener('click', () => {
            window.open (
            "{{ URL::to('order/receipt/'.$order_ref) }}", 
            "_blank"
        );

        });

    }, 1000);
</script>
