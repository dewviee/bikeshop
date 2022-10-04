<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function viewCart() {
        return view('cart/index');
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
}
