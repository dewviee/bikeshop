@extends("layouts.master") @section('title') BikeShop | ตะกร้าสินค้า @stop
@section('content')
<div class="container">
    <h1>สินค้าในตะกร้า</h1>
    <div class="breadcrumb">
    <li><a href="{{ URL::to('home') }}"><i class="fa fa-home"></i> หน้าร้าน</a></li>
    <li class="active">สินค้าในตะกร้า</li>
    </div>

    <div class="panel panel-default">
        @if($cart_items)
        <?php $sum_price = 0 ?>
        <?php $sum_qty = 0 ?>
        
        <table class="table bs-table">
            <thead>
            <tr>
                <th>รูปสินค้า </th>
                <th>รหัส</th>
                <th>ชื่อสินค้า </th>
                <th>จํานวน</th>
                <th>ราคา</th>
                <th width="50px"></th>
            </tr>
            </thead>
            <tbody>
                @foreach($cart_items as $c)
                <tr>
                    <td><img src="{{ asset($c['image_url']) }}" height="36"></td>
                    <td>{{ $c['code'] }}</td>
                    <td>{{ $c['name'] }}</td>
                    <td>
                        <input 
                        type="number" class="form-control" 
                        value="{{ $c['qty'] }}" 
                        size="1"
                        min="1"
                        onchange="updateCart({{$c['id']}}, this)"
                        {{-- onKeyUp="updateCart({{$c['id']}}, this)" --}}
                        >
                    </td>
                    <td>{{ number_format($c['price']*$c['qty'], 0) }}</td>
                    
                    <td>
                        <a href="{{ URL::to('cart/delete/'.$c['id']) }}" class="btn btn-danger">
                        <i class="fa fa-times"></i></a>
                    </td>
                
                </tr>
                <?php $sum_price += $c['price']*$c['qty'] ?>
                <?php $sum_qty += $c['qty'] ?>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                <th colspan="3">รวม</th>
                <th>{{ number_format($sum_qty, 0) }}</th>
                <th>{{ number_format($sum_price, 0) }}</th>
                <th></th>
                </tr>
            </tfoot>
        </table>
        @else
        <div class="panel-body"><strong>ไม่พบรายการสินค้า !</strong></div>
        @endif
    </div>

    <!-- buttons -->
    <a href="{{ URL::to('/home') }}" class="btn btn-default">ย้อนกลับ </a>

    <div class="pull-right">
    <a href="{{ URL::to('cart/checkout') }}"
    class="btn btn-primary">ชําระเงิน <i class="fa fa-chevron-right"></i></a>
    </div>
</div>

<script>
    function updateCart(id, qty) {
        if (qty.value >= 0){
            window.location.href = '/cart/update/' + id + '/' + qty.value;
        }else{
            alert("จำนวนสินค้า: " + qty.name + " ต้องไม่น้อยกว่า 0");
        }
    }
</script>
@endsection