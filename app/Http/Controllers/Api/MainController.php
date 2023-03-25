<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;


class MainController extends Controller
{


    public function category()
    {
        $categories = Category::all();
        return response()->json($categories);
    }
    public function products($id){
        $product=Product::where('category_id',$id)->get();
        return response()->json($product);

    }




}
