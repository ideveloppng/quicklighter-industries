<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return back()->with('success', 'Category Registered Successfully');
    }

    // FIXED: Added the $ sign before the variable name
    public function destroy(Category $category)
    {
        if($category->products()->count() > 0) {
            return back()->with('error', 'Cannot delete: Products are linked to this category.');
        }

        $category->delete();
        return back()->with('success', 'Category Removed Successfully');
    }
}