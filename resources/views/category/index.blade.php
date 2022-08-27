@extends("layouts.master")
@section('title') BikeShop | รายการประเภทสินค้า @stop
@section('content')

<div class="container">

    <h1>รายการประเภทสินค้า</h1>

    {{-- Show error when error --}}
    @if($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
        @endforeach
    </div>
    @endif


    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title"><strong>รายการ</strong></div>
        </div>

        <div class="panel-body">
            <!-- search form -->
            <form action="{{ URL::to('category/search') }}" method="post" class="form-inline">
                @CSRF
                {{ csrf_field() }}
                <input type="text" name="q" class="form-control" placeholder="พิมพ์รหัสหรือชื่อเพื่อค้นหา">
                <button type="submit" class="btn btn-primary">ค้นหา</button>
                <a href="{{ URL::to('category/edit') }}" class="btn btn-success pull-right">เพิ่มประเภทสินค้า</a>
            </form> 
        </div>

        <table class="table table-bordered bs_table">
            <thead>
                <tr>
                    <th>รหัส</th>
                    <th>ประเภท</th>
                    <th>การทำงาน</th>
                </tr>
            </thead>
    
            <tbody>
                @foreach($categorys as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->name }}</td>
                    <td class="bs-center">
                        <a href="{{ URL::to('category/edit/'.$p->id) }}" class="btn btn-info"><i class="fa fa-edit"></i> แก้ไข</a>
                        <a href="#" class="btn btn-danger btn-delete" id-delete="{{ $p->id }}">
                            <i class="fa fa-trash"></i> ลบ</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="panel-footer">
            <span>แสดงข้อมูลจํานวน {{ count($categorys) }} รายการ</span>
        </div>
        {{ $categorys->links() }}

    </div>
    
</div>

<script>
    // ใช้เทคนิค jQuery
    $('.btn-delete').on('click', function() { if(confirm("คุณต้องการลบประเภทสินค้าหรือไม่?")) {
    var url = "{{ URL::to('category/remove') }}"
    + '/' + $(this).attr('id-delete'); window.location.href = url;
    }
    });
</script>
@endsection