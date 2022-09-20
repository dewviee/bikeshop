@extends("layouts.master")
@section('title') BikeShop | อุปกรณ์จักรยาน, อะไหล่, ชุดแข่ง และอุปกรณ์ตกแต่ง @stop
@section('content')

<div class="container" ng-app="app" ng-controller="ctrl">
    <center><h1>@{ helloMessage }</h1></center> 
</div>

<script type="text/javascript">
    var app = angular.module('app', []).config(function ($interpolateProvider) {
    $interpolateProvider.startSymbol('@{').endSymbol('}');
    });
    app.controller('ctrl', function ($scope) {
    $scope.helloMessage = 'ยินดีต้อนรับสู่ AngularJS';
    });
</script>

@endsection