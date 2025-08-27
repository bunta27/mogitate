<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('search');

        $sortOrder = trim((string)$request->input('order'));

        $query = Product::query();

        if ($keyword !== null && $keyword !== '') {
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
        $product = Product::with('seasons:id')->findOrFail($productId);
        $seasons = Season::all();
        return view('products.detail', compact('product','seasons'));
    }

    public function update(UpdateProductRequest $request, $productId)
    {
        $product   = Product::findOrFail($productId);
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($product->image && str_starts_with($product->image, '/storage/')) {
                $old = str_replace('/storage/', '', $product->image);
                Storage::disk('public')->delete($old);
            }
            $path = $request->file('image')->store('products', 'public');
            $product->image = Storage::url($path);
        }

        $product->name        = $validated['name'];
        $product->price       = $validated['price'];
        $product->description = $validated['description'];
        $product->save();

        $product->seasons()->sync($validated['seasons']);

        return redirect()->route('products')->with('status', '商品を更新しました');
    }

    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);

        if ($product->image && str_starts_with($product->image, '/storage/')) {
            $old = str_replace('/storage/', '', $product->image);
            Storage::disk('public')->delete($old);
        }

        $product->seasons()->detach();
        $product->delete();

        return redirect()->route('products')->with('status', '商品を削除しました');
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
