<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Product;
use App\Models\Category;

class CartController extends Controller{
    public function __construct() { 
        $this->middleware('auth');
    }


    public function viewCart() {
        $cart_items = Session::get('cart_items');
        return view('cart/index', compact('cart_items'));
    }
        
    public function addToCart($id) {
        $product = Product::find($id);

        $cart_items = Session::get('cart_items');
        if(is_null($cart_items)) {
            $cart_items = array();
        }

        $qty = 0;
        if(array_key_exists($product->id, $cart_items)) {
            $qty = $cart_items[$product->id]['qty'];
        }

        $cart_items[$product['id']] = array( 
            'id' => $product->id,
            'code' => $product->code,
            'name' => $product->name,
            'price' => $product->price,
            'image_url' => $product->image_url,
            'qty' => $qty + 1,
        );
        Session::put('cart_items', $cart_items);
        return redirect('cart/view');

    }

    public function checkout() {
        $cart_items = Session::get('cart_items');
        return view('cart/checkout', compact('cart_items'));
    }

    public function complete(Request $request) {
        $cart_items = Session::get('cart_items');
        $cust_name = $request->cust_name;
        $cust_email = $request->cust_email;
        $po_no = 'PO'.date("Ymd");
        $po_date = date("Y-m-d H:i:s");
        $total_amount = 0;

        foreach($cart_items as $c) {
            $total_amount += $c['price'] * $c['qty'];
        }


        $html_output = view('cart/complete', compact('cart_items', 'cust_name', 'cust_email',
        'po_no', 'po_date', 'total_amount'))->render();
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->debug = true;
        $mpdf->WriteHTML($html_output);
        $mpdf->Output('output.pdf', 'I');
        return $resp->withHeader("Content-type", "application/pdf");
    }

    public function finish_order() {
        $cart_items = Session::get('cart_items'); 
        Session::remove('cart_items');
        return redirect('home');
    }

    public function deleteCart($id) {
        $cart_items = Session::get('cart_items');
        unset($cart_items[$id]);
        Session::put('cart_items', $cart_items);
        return redirect('cart/view');
    }

    public function updateCart($id, $qty) {
        $cart_items = Session::get('cart_items');
        $cart_items[$id]['qty'] = $qty;
        Session::put('cart_items', $cart_items);
        return redirect('cart/view');
        }
    
}
