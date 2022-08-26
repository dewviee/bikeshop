@extends("layouts.master") 
@section('title') BikeShop | แก้ไขข้อมูลสินค้า @stop
@section('content')

<div class="container">

<h1>แก้ไขสินค้า </h1>
<ul class="breadcrumb">
    <li><a href="{{ URL::to('product') }}">หน้าแรก</a></li>
    <li class="active">แก้ไขสินค้า </li>
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
            <strong>ข้อมูลสินค้า </strong>
        </div>
    </div>
    <div class="panel-body">
        {!! Form::model(
            $product, array('action' => 'App\Http\Controllers\ProductController@update',
            'method' => 'post',
            'enctype' => 'multipart/form-data')) !!}
        <input type="hidden" name="id" value="{{ $product->id }}">
        <table>
            @if($product->image_url)
            <tr>
            <td><strong>รูปสินค้า </strong></td>
            <td><img src="{{ URL::to($product->image_url) }}" width="100px"></td>
            </tr> @endif
            <tr>
                <td>{{ Form::label('code', 'รหัสสินค้า') }} </td>
                <td>{{ Form::text('code', $product->code, ['class' => 'form-control']) }}</td>
            </tr>
            <tr>
                <td>{{ Form::label('name', 'ชื่อสินค้า ') }}</td>
                <td>{{ Form::text('name', $product->name, ['class' => 'form-control']) }}</td>
            </tr>
            <tr>
                <td>{{ Form::label('category_id', 'ประเภทสินค้า ') }}</td>
                <td>{{ Form::select('category_id', $categories, Request::old('category_id'), ['class' => 'form-control']) }}
            </tr>
            <tr>
                <td>{{ Form::label('stock_qty', 'คงเหลือ') }}</td>
                <td>{{ Form::text('stock_qty', $product->stock_qty, ['class' => 'form-control']) }} </td>
            </tr>
            <tr>
                <td>{{ Form::label('price', 'ราคาขายต่อหน่วย') }}</td>
                <td>{{ Form::text('price', $product->price, ['class' => 'form-control']) }}</td>
            </tr>
            <tr>
                <td>{{ Form::label('image', 'เลือกรูปภาพสินค้า ') }}</td>
                <td>{{ Form::file('image') }}</td>
            </tr>
        </table>   
    </div>
    <div class="panel-footer">
            <button type="reset" class="btn btn-danger">ยกเลิก</button>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i> บันทึก</button>
    </div>
</div>

{!! Form::close() !!}
</div>
@endsection