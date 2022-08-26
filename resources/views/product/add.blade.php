@extends("layouts.master") 
@section('title') BikeShop | เพิ่มสินค้า @stop
@section('content')

<div class="container">

<h1>เพิ่มสินค้า </h1>
<ul class="breadcrumb">
    <li><a href="{{ URL::to('product') }}">หน้าแรก</a></li>
    <li class="active">เพิ่มสินค้า </li>
</ul> 
@if($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <strong>เพิ่มข้อมูลสินค้า </strong>
        </div>
    </div>
    <div class="panel-body">
        {!! Form::open(array('action' => 'App\Http\Controllers\ProductController@insert',
        'method'=>'post', 
        'enctype' => 'multipart/form-data')) !!}
        <table>
        <tr>
        <td>{{ Form::label('code', 'รหัสสินค้า ') }}</td>
        <td>{{ Form::text('code', Request::old('code'), ['class' => 'form-control']) }}</td>
        </tr>
        <tr>
        <td>{{ Form::label('name', 'ชื่อสินค้า ') }}</td>
        <td>{{ Form::text('name', Request::old('name'), ['class' => 'form-control']) }}</td>
        </tr>
        <tr>
        <td>{{ Form::label('category_id', 'ประเภทสินค้า ') }}</td>
        <td>{{ Form::select('category_id', $categories, Request::old('category_id'),
        ['class' => 'form-control']) }}</td>
        </tr>

        <tr>
        <td>{{ Form::label('stock_qty', 'คงเหลือ') }}</td>
        <td>{{ Form::text('stock_qty', Request::old('stock_qty'), ['class' => 'form- control']) }}</td>
        </tr>

        <tr>
        <td>{{ Form::label('price', 'ราคาขายต่อ หน่วย') }}</td>
        <td>{{ Form::text('price', Request::old('price'), ['class' => 'form-control']) }}</td>
        </tr>
        <tr>
            <td>{{ Form::label('image', 'เลือกรูปภาพสินค้า ') }}</td>
            <td>{{ Form::file('image') }}</td>
        </tr>

        </table>

    </div>

    <div class="panel-footer">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-save"></i> บันทึก</button>
    </div>

</div>
{!! Form::close() !!}
@endsection