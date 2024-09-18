<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Stock;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'brand', 'stock', 'images']);
    
        $query->when($request->filled('category'), function ($query) use ($request) {
            return $query->where('category_id', $request->input('category'));
        })->when($request->filled('brand'), function ($query) use ($request) {
            return $query->where('brand_id', $request->input('brand'));
        })->when($request->filled('min_price'), function ($query) use ($request) {
            return $query->where('price', '>=', $request->input('min_price'));
        })->when($request->filled('max_price'), function ($query) use ($request) {
            return $query->where('price', '<=', $request->input('max_price'));
        })->when($request->filled('name'), function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->input('name') . '%');
        });
    
        $products = $query->paginate(10);
    
        $categories = Category::all();
        $brands = Brand::all();
    
        return view('products.index', compact('products', 'categories', 'brands'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('products.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        $product = Product::create($validatedData);

        Stock::create([
            'product_id' => $product->id,
            'quantity' => $validatedData['quantity'],
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('product_images', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'image_url' => $path,
            ]);
        }

        return redirect()->route('products.index')->with('完成', '产品创建完成。');
    }

    public function show(Product $product)
    {
        $product->load(['category', 'brand', 'stock', 'images']);
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0|max:9999999.99',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        $product->update($validatedData);

        $product->stock->update(['quantity' => $validatedData['quantity']]);

        if ($request->hasFile('image')) {
            // 删除旧图片
            if ($product->images->isNotEmpty()) {
                Storage::disk('public')->delete($product->images->first()->image_url);
                $product->images->first()->delete();
            }

            // 上传新图片
            $path = $request->file('image')->store('product_images', 'public');
            $product->images()->create(['image_url' => $path]);
        }

        return redirect()->route('products.show', $product)->with('success', '产品更新成功');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('完成', '产品删除完成。');
    }

    public function dashboard()
    {
        $totalProducts = Product::count();
        $latestProducts = Product::latest()->take(5)->get();
        $categories = Category::withCount('products')->get();
        $brands = Brand::withCount('products')->get();

        return view('dashboard', compact('totalProducts', 'latestProducts', 'categories', 'brands'));
    }

    public function search(Request $request)
    {
        // 这里可以调用 index 方法或复制其逻辑
        return $this->index($request);
    }
}