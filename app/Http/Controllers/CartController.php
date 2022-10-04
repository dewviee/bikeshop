<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function viewCart() {
        return view('cart/index');
    }
        
        public function addToCart($id) {
        return redirect('cart/view');
    }
}
