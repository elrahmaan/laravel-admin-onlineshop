<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductApiController extends Controller
{
    public function index(){
        $products = Product::all();
        return response()->json(['message' => 'Success', 'table' => 'products', 'data' => $products]);
    }
    
    public function show($id){
        $product = Product::find($id);
        return response()->json(['message' => 'Success', 'table' => 'products', 'data' => $product]);
    }  
}
