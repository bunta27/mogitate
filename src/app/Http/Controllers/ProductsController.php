<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('search');

        $sortOrder = $request->input('order');

        $query = Product::query();

        if (!empty($keyword)) {
            $query->where('name', 'like', "{$keyword}");
        }

        if ($sortOrder === 'price_asc') {
            $query->orderBy('price','asc');
        } elseif ($sortOrder === 'price_desc') {
            $query->where('price','desc');
        }

        $products = $query->paginate(6)->appends($request->query());

        return view('products.index', [
            'products' => $puroducts,
            'keyword' => $keyword,
            'sortOrder' => $sortOrder,
        ]);
    }

    public function show($productId)
    {
        $product = Product::findOrFail($productId);
        return view('products.detail', compact('product'));
    }

}
