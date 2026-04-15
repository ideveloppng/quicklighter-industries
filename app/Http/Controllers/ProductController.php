<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Public Shop Methods
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = Product::with('category')->where('is_active', true);

        // HANDLE SEARCH LOGIC
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        // Handle Category filtering
        if ($request->has('category') && !empty($request->category)) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $products = $query->latest()->paginate(12)->withQueryString(); // withQueryString keeps search in pagination
        $categories = Category::all();

        return view('shop.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        $related = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();

        return view('shop.show', compact('product', 'related'));
    }

    /*
    |--------------------------------------------------------------------------
    | Admin Inventory Methods
    |--------------------------------------------------------------------------
    */

    public function adminIndex()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        if ($categories->isEmpty()) {
            return redirect()->route('admin.categories.index')->with('error', 'Registry Error: Create a category first.');
        }
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $images[] = $image->store('products', 'public');
            }
        }

        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . rand(100, 999),
            'description' => $request->description,
            'price' => $request->price,
            'old_price' => $request->old_price,
            'stock' => $request->stock,
            'images' => $images,
            'is_featured' => $request->has('is_featured'),
            'is_active' => true,
        ]);

        return redirect()->route('admin.products')->with('success', 'Unit Registry Authorized.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $data = [
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'old_price' => $request->old_price,
            'stock' => $request->stock,
            'is_featured' => $request->has('is_featured'), 
        ];

        if ($request->hasFile('images')) {
            if ($product->images) {
                foreach ($product->images as $oldPath) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
            $newImages = [];
            foreach ($request->file('images') as $image) {
                $newImages[] = $image->store('products', 'public');
            }
            $data['images'] = $newImages;
        }

        $product->update($data);

        return redirect()->route('admin.products')->with('success', 'Unit Configuration Updated.');
    }

    public function destroy(Product $product)
    {
        if ($product->images) {
            foreach ($product->images as $path) {
                Storage::disk('public')->delete($path);
            }
        }
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Unit Decommissioned.');
    }
}