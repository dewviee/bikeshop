<!DOCTYPE html>
<html lang="en">
<head>
    {{-- contenttype --}}
    

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report</title><script src="{{ asset('js/cart.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.0/html2pdf.bundle.min.js" integrity="sha512-w3u9q/DeneCSwUDjhiMNibTRh/1i/gScBVp2imNVAMCt6cUHIw6xzhzcPFIaL3Q1EbI2l+nu17q2aLJJLo4ZYg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <style>
        body {
            font-family: "Garuda", sans-serif;
        }
    </style>

</head>
<body id="contentToPrint">
    
    <table border="0" width="100%">
        <tr>
            <td colspan="2" align="center"><h1>ใบสั่งซื้อ</h1><h2>(Purchase Order)</h2>
            </td>
        </tr>
        <tr>
            <td>
                <table border="0" width="100%">
                    <tr>
                        <td>
                            <strong>ชื่อลูกค้า :</strong>
                            {{-- {{ Auth::user()->name }} --}}
                            {{ $cust_name; }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>อีเมล์ : </strong>
                            {{-- {{ Auth::user()->email }} --}}
                            {{ $cust_email; }}
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <table border="0" width="100%">
                    <tr>
                        <td class="wfull-flex-end">
                            <strong>เลขที่ : </strong>
                            <span>&nbsp;{{ $order_no; }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="wfull-flex-end">
                            <strong>วันที่ : </strong>
                            <span>&nbsp;{{ $order_date; }}</span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    
        <tr>
            <td colspan="2">
                <table border="1" width="100%" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>ลําดับ </th>
                            <th>ชื่อสินค้า </th>
                            <th>ราคา/หน่วย</th>
                            <th>จํานวน</th>
                            <th>รวมเงิน</th>
                        </tr>
                    </thead>
                    <tbody class="_cart_tbody_report">
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
            </td>
        </tr>
    
        <tr>
            <td>
                <h4>หมายเหตุ</h4>
                <ul>
                    <li>ชําระเงินโดยโอนเข้าบัญชีXXX ธนาคาร YYY สาขา ZZZ (ออมทรัพย)์</li>
                    <li>กรุณาชําระเงินภายใน 7 วัน หลังจากที่สั่งซื้อ</li>
                    <li>ชําระเงินแล้วส่งหลักฐานมาที่ sales@bikeshop.com <br />&nbsp;&nbsp;&nbsp;หรือ LINE: @bikeshop</li>
                </ul>
            </td>
            <td align="right">
                <strong>จํานวนเงินรวมทั้งสิ้น</strong> 
                <h2 class="_cart_total_price">{{ $total_price }}</h2>
            </td>
        </tr>
    </table>
    
    {{-- <div class="pull-right">
        <a href="{{ URL::to('home') }}" class="btn btn-primary"><i class="fa fa-check"></i> จบการขาย</a>
    </div> --}}

</body>
</html>










<style>
    
    .wfull-flex-end {
        width: 100% !important;
        display: flex !important;
        justify-content: flex-end !important;
        align-items: flex-end !important;
    }

</style>