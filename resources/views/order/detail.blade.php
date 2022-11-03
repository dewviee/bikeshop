@extends('layouts.master')

@section('title')
    BikeShop | Detail Order
@endsection

@section('tag_head')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@endsection

@section('content')
    <div class="container" ng-app="app" ng-controller="controller">
        <h1>Detail Order</h1>
        <div class="breadcrumb">
            <li><a href="{{ URL::to('home') }}"><i class="fa fa-home"></i> หน้าร้าน</a></li>
            <li class="active"> <a href="{{URL::to('order')}}"> Order </a></li>
            <li class="active">Detail of {{$order->order_ref}}</li>
        </div>

        {{-- @if (count($cart_items)) --}}

        <input id="order_id" type="hidden" value="{{$order->id}}">

        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tbody>

                    <tr>
                        <th>เลขที่ใบสั่งซื้อ</th>
                        <th>ชื่อลูกค้า</th>
                        <th>อีเมล์</th>
                        <th>วันที่สั่งซื้อสินค้า</th>
                        <th>สถานะการชําระเงิน</th>
                    </tr>

                        <tr>
                            <td>{{ $order->order_ref }}</td> 
                            <td>{{ $order->user_fullname }}</td>
                            <td>{{ $order->user_email }}</td>
                            <td>{{ $order->created_at->format('Y/m/d') }}</td>
                            <td><input data-id="{{$order->status}}" class="toggle-class" 
                            type="checkbox" data-onstyle="success" data-offstyle="danger"
                            data-toggle="toggle" data-on="ชำระเงินแล้ว" data-off="ยังไม่ชำระเงิน"
                            {{$order->status == 1 ? 'checked' : ''}}> </td>

                        </tr>

                </tbody>
            </table>
            <table class="table table-bordered table-striped table-hover">
                <tbody>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อสินค้า</th>
                        <th class="text-right">ราคาต่อหน่วย</th>
                        <th class="text-right">จำนวน</th>
                        <th class="text-right">รวมเงิน</th>
                    </tr>
                    @foreach ($order_details as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td class="text-right">{{ $item->price }}</td>
                            <td class="text-right">{{ $item->qty }}</td>
                            <td class="text-right">{{ $item->total }}</td>
                            
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr colspan="4">
                        <th></th>
                        <th>รวม</th>
                        <th></th>
                        <th class="text-right">{{count($order_details)}}</th>
                        <th class="text-right">{{number_format($total_price,2)}}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <script>
            $(function(){
                $('.toggle-class').change(function(){
                    let statusOrder = $(this).prop('checked') == true ? 1 : 0;
                    let idOrder = document.querySelector('#order_id').value;
                    setTimeout(() => {
                        window.location.href = `./changeStatusOrder/${idOrder}/${statusOrder}`;
                    }, 1000);
                }); 
            });
        </script>
    </div>
    
@endsection
