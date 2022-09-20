@extends("layouts.master")
@section('title') BikeShop | อุปกรณ์จักรยาน, อะไหล่, ชุดแข่ง และอุปกรณ์ตกแต่ง @stop
@section('content')

<div class="container" ng-app="app" ng-controller="ctrl">
    <center><h1>@{ helloMessage }</h1></center> 

    <input type="text" class="form-control" ng-model="query.name" placeholder="ค้นหา">

    <br>
    <table class="table table-bordered">
        
        <thead>
        <tr>
            <th>รหัส</th>
            <th>ชื่อสินค้า </th>
            <th>ราคาขาย</th>
            <th>คงเหลือ</th>
            <th>สถานะ</th>
        </tr>
        </thead>
        <tr ng-repeat="p in filterProducts = (products|filter:query)">   
            <h3 ng-show="!filterProducts.length">ไม่พบข้อมูลสินค้า </h3>
            <td>@{p.code}</td>
            <td>@{p.name}</td>
            <td>@{p.price}</td>
            <td>@{p.qty}</td>
            <td>
                <span ng-if="p.qty >= 5 "
                    ng-class="{'label label-success':p.qty >= 5}">มีสินค้า</span>
                <span ng-if="p.qty > 0 && p.qty < 5"
                    ng-class="{'label label-warning': p.qty > 0 && p.qty < 5}">สินค้าใกล้หมด</span>
                <span ng-if="p.qty == 0"
                    ng-class="{'label label-danger': p.qty == 0}">สินค้าหมด</span>
            </td>
        </tr>
        
    </table>
    
</div>

<script type="text/javascript">
    var app = angular.module('app', []).config(function ($interpolateProvider) {
    $interpolateProvider.startSymbol('@{').endSymbol('}');
    });
    app.controller('ctrl', function ($scope) {
    $scope.helloMessage = 'ยินดีต้อนรับสู่ AngularJS';
    $scope.adminName = 'Saharat';
    $scope.products = [
        {'code': 'P001', 'name': 'ชุดแข่งสีดา Size L', 'price': 1500.00, 'qty': 5},
        {'code': 'P002', 'name': 'หมวกกันน็อกรุ่น SM-220', 'price': 1400.00, 'qty': 0},
        {'code': 'P003', 'name': 'มิเตอร์วัดความเร็ว', 'price': 1450.00, 'qty': 2},
    ];
    });
</script>

@endsection