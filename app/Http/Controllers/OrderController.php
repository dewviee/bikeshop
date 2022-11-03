<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Product;

use Carbon\Carbon;
use App\Models\User;
class OrderController extends Controller
{
    public function index() {


        // Show latest order by id first.
        // $orders = Order::latest()->orderBy('id', 'desc')->get();
        $orders = Order::all();
        
        // change name id to name string each user.
        foreach ( $orders as $order){
            $order->user_id = User::where('id', $order->user_id)->first()->name;
        }

        return view('order.index',compact('orders'));
    }


    public function detail($id = null) {
        $order = Order::where('id', $id)->first();

        $order_details = Order_Detail::where('order_id', $id)->get();
        $total_price = 0;
        
        foreach ( $order_details as $item){
            $item->name = Product::where('id', $item->product_id)->first()->name;
            $total_price += $item->total;
        }

        $order->user_id = User::where('id', $order->user_id)->first()->name;
            

        
        return view('order.detail',compact('order_details','order','total_price'));
        
    }
    

    public function receipt($id = null) {
        $order = Order::where('order_ref', $id)->first();
        $order_details = Order_Detail::where('order_id', $order->id)->get();
        $user = User::where('id', $order->user_id)->first();

        // New PDF zone
        $order_no = $order->order_ref;
        $order_date = $order->created_at->format('Y-m-d');
        $cust_name = $order->user_fullname;
        $cust_email = $order->user_email;
        $total_price = 0;

        foreach ( $order_details as $item){
            $item->name = Product::where('id', $item->product_id)->first()->name;
            $total_price += $item->total;
            
        }

        
        $html_output = view('order.receipt', 
            compact(
                'order_details', 'cust_name', 'cust_email', 'total_price',
                'order_no', 'order_date'
            )
        )->render();
        
        $mpdf = new \Mpdf\Mpdf();
        
        $mpdf->debug = true;
        $mpdf->WriteHTML($html_output);
        $mpdf->Output($order->order_ref.'.pdf', 'i');

        return $resp->withHeader("Content-type", "application/pdf");
    }


    // Create order in database
    public function create(Request $body){
        $cart_items = Session::get('cart_items');
        $order = new Order();
        $order->user_id = $body->cust_userid;
        $order->user_fullname = $body->cust_name;
        $order->user_email = $body->cust_email;
        $order->order_ref = $this->create_order_id();
        $order->status = 0;
        $order->save();

        foreach ($cart_items as $p){
            $order_details = new Order_Detail();
            $order_details->order_id = $order->id;
            $order_details->product_id = $p['id'];
            $order_details->qty = $p['qty'];
            $order_details->price = $p['price'];
            $order_details->total = $p['price'] * $p['qty'];
            $order_details->save();
        }

        //return order_ref number
        return $order->order_ref;
    }



    // Created use function for generating order id
    public function create_order_id(){
        //format "PO20180218####"
        //format "POYYYYMMDD####" 14 characters

        $latestOrder = Order::orderBy('created_at','DESC')->first();
        
        if($latestOrder->created_at->format('Y-m-d') != Carbon::now()->format('Y-m-d')){
            $orderDigit = "0001";
        }else{
            $latestDigit = substr($latestOrder->order_ref, 10, 4);
            $orderDigit = sprintf('%04s', ((int)$latestDigit)+1); 

        }

        $order_id = 'PO'.date('Ymd').$orderDigit;
        return $order_id;
    }
    
    
    // public function changeMemberStatus(Request $request)
    // {
    //     $order = Order::find($request->order);
    //     $order->status = $request->status;
    //     $order->save();
    // }

    public function changeStatusOrder($idOrder, $statusOrder)
    {
        $order = Order::find($idOrder);
        $order->status = $statusOrder;
        $order->save();

        return redirect('order/detail/'.$idOrder);
    }

}
