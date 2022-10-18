@extends("layouts.master")
@section('content')
<div class="container">
    <h1>ชําระเงิน</h1>

    <div class="breadcrumb">
        <li><a href="{{ URL::to('home') }}"><i class="fa fa-home"></i>หน้าร้าน</a></li>
        <li><a href="{{ URL::to('cart/view') }}">สินค้าในตะกร้า</a></li>
        <li class="active">ชําระเงิน</li>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong>รายการสินค้า</strong>
                    </div>
                </div>
                <table class="table bs-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>รหัส</th>
                            <th>ชื่อสินค้า </th>
                            <th>จํานวน</th>
                            <th class="bs-price">ราคา</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $sum_price = 0; $sum_qty = 0; ?>
                        @foreach($cart_items as $c)
                        <tr>
                            <td><img src="{{ asset($c['image_url']) }}" width="32"></td>
                            <td>{{ $c['code'] }}</td>
                            <td>{{ $c['name'] }}</td>
                            <td>{{ number_format($c['qty'], 0) }}</td>
                            <td class="bs-price">{{ number_format($c['price']*$c['qty'], 0) }}</td>
                        </tr>
                        <?php $sum_price += $c['price']*$c['qty'] ?>
                        <?php $sum_qty += $c['qty'] ?>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                        <th colspan="3">รวม</th>
                        <th>{{ number_format($sum_qty, 0) }}</th>
                        <th class="bs-price">{{ number_format($sum_price, 0) }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
        </div>

        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong>ข้อมูลลูกค้า </strong>
                    </div>
                </div>
                <div class="panel-body">
                    
                    <div class="form-group">
                        <label>ชื่อ-นามสกุล</label>
                        <input type="text" class="form-control" 
                        id="cust_name" placeholder="ชื่อ-นามสกุล" 
                        value="{{Auth::user()->name}}">
                    </div>
                    
                    <div class="form-group">
                        <label>อีเมล</label>
                        <input type="text" class="form-control" 
                        id="cust_email" placeholder="อีเมล์ของท่าน"
                        value="{{Auth::user()->email}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ URL::to('cart/view') }}" class="btn btn-default">ย้อนกลับ </a>
    <div class="pull-right">
    <a href="javascript:complete()" class="btn btn-warning">พิมพ์ใบสั่งซื้อ</a>
    <a href="javascript:finish()" class="btn btn-primary"><i class="fa fa-check"></i>จบการขาย</a>
    </div>
</div>

<script type="text/javascript"> 
    function complete() {
        window.open (
            "{{ URL::to('cart/complete') }}?cust_name="+ $('#cust_name').val() + '&cust_email='
            + $('#cust_email').val(), 
            "_blank",
        );
    }

    function finish(){
        window.open (
            "{{ URL::to('cart/complete') }}?cust_name="+ $('#cust_name').val() + '&cust_email='
            + $('#cust_email').val(), 
            "_blank",
            window.location.href = "{{ URL::to('cart/finish') }}"
        );
    }

    

</script>
@stop