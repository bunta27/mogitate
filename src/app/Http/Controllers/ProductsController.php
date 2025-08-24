<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('search');

        $sortOrder = $request->input('order');

        $query = Product::query();

        if (!empty($keyword)) {
            $query->where('name', 'like', "%{$keyword}%");
        }

        if ($sortOrder === 'price_asc') {
            $query->orderBy('price','asc');
        } elseif ($sortOrder === 'price_desc') {
            $query->orderBy('price','desc');
        }

        $products = $query->paginate(6)->appends($request->query());

        return view('products.index', [
            'products' => $products,
            'keyword' => $keyword,
            'sortOrder' => $sortOrder,
        ]);
    }

    public function show($productId)
    {
        $product = Product::findOrFail($productId);
        return view('products.detail', compact('product'));
    }

    public function create()
    {
        $seasons = Season::all();
        return view('products.register', compact('seasons'));
    }

    public function store(ProductRequest $request)
    {
        $validated = $request->validated();

        $path = $request->file('image')->store('products', 'public');

        $imageUrl = Storage::url($path);

        $product = Product::create([
        'name'        => $validated['name'],
        'price'       => $validated['price'],
        'image'       => $imageUrl,
        'description' => $validated['description'],
        ]);

        $product->seasons()->sync($validated['seasons']);

        return redirect()->route('products')->with('status', '商品を登録しました');
    }
}
