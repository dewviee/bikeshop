@extends("layouts.master")
    @section('title') BikeShop | รายการสินค้า @stop

    {{-- This is nav --}}
    @section('content') 

    <div class="container">

    <h1>รายการสินค้า </h1>
    <div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title"><strong>รายการ</strong></div>
    </div>
    

    <div class="panel-body">
        <!-- search form -->
        <form action="{{ URL::to('product/search') }}" method="post" class="form-inline">
            @CSRF
        <input type="text" name="q" class="form-control" placeholder="...">
        <button type="submit" class="btn btn-primary">ค้นหา</button>
        </form>
    </div> 
    <table class="table table-bordered bs_table">
    <thead>
    <tr>
    <th>รหัส</th>
    <th>ประเภท</th>
    </tr>
    </thead>
    <tbody>
        @foreach($categorys as $p)
        <tr>
        <td>{{ $p->id }}</td>
        <td>{{ $p->name }}</td>
        
        </tr> @endforeach
        </tbody>
        <tfoot>
            <tr>
            <th class="bs-price">รวม</th>
            <th class="bs-price">{{ $categorys->sum('stock_qty') }}</th>

            </tr>
            </tfoot>
        </table>
        
        <div class="panel-footer">
        </div>
    </div>  
    </div>        
    @endsection