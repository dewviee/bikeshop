<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryControllerApi extends Controller
{
    public function category_list(){
        $categories = Category::all();

        return response()->json(array(
            'ok' => true,
            'categories' => $categories,
        ));
    }
}
