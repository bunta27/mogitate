<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\ProductRequest;
use App\Models\Product;
use App\Models\Season;

class ProductsController extends Controller
{
    public function product()
    {
        $products = Product::all();
        return view('product', compact('products'));
    }


}
