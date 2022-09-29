<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;


class ProductControllerApi extends Controller
{

    public function product_list($category_id = null) {
        if($category_id) {
            $products = Product::where('category_id', $category_id)->get();
        } else {
            $products = Product::all();
        }
        return response()->json(array ( 
            'ok' => true,
            'products' => $products,
        ));
    }

    public function product_search(Request $request) {
        /*
        Sourced: https://stackoverflow.com/questions/48007222/parameterbag-could-not-be-converted-to-string-laravel-5-5
        $request->query 
        is an object of type ParameterBag which contains the Query Params for GET Requests.
        You should rather use $request->get('query') in these circumstances
        */
        $query = $request->get('query');
        
        if($query) {
            $products = Product::where('name', 'like', '%'.$query.'%')->get();
        } else {
            $products = Product::all();
        }
        
        return response()->json(array( 
            'ok' => true,
            'products' => $products,
        ));
    }

}
