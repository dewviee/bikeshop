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
            <li class="active">Detail Order</li>
            <li class="active">Detail of PD12451259592</li>
        </div>

        {{-- @if (count($cart_items)) --}}

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

                    @foreach ($orders as $item)
                        <tr>
                            <td>{{ $item->order_ref }}</td> 
                            <td>{{ $item->user_fullname }}</td>
                            <td>{{ $item->user_email }}</td>
                            <td>{{ $item->created_at->format('Y/m/d') }}</td>
                            @if ($item->status == 0)
                                <td class="bg-danger">ยังไม่ชำระเงิน</td>
                            @elseif ($item->status == 1)
                                <td class="bg-success">ชำระเงินแล้ว</td>
                            @elseif($item->status == -1)
                                <td class="bg-secondary">ยกเลิกโดยแอดมิน</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <table class="table table-bordered table-striped table-hover">
                <tbody>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อสินค้า</th>
                        <th>ราคาต่อหน่วย</th>
                        <th>จำนวน</th>
                        <th>รวมเงิน</th>
                    </tr>

                    @foreach ($order_details as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>{{ $item->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
