<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of products (frontend filtered view).
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $category = $request->query('category', 'All Categories');

        $query = Product::query()->where('is_active', true);

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($category && $category !== 'All Categories') {
            $query->where('category', $category);
        }

        // Keep as Eloquent models
        $products = $query->get();

        // Get distinct categories
        $categories = Product::select('category')->distinct()->pluck('category');

        return view('pages.products', [
            'filteredProducts' => $products,
            'categories' => $categories,
            'category' => $category,
            'search' => $search,
        ]);
    }

    public function adminIndex()
    {
        // 1. Fetch all products, including inactive ones, for the Admin view.
        // We'll order them by ID or name for a consistent list.
        $allProducts = Product::orderBy('id', 'desc')->get();

        // 2. Pass the fetched products to the view using the variable name
        //    $filteredProducts which is what admin.products.index expects.
        return view('admin.products.index', [
            'filteredProducts' => $allProducts,
        ]);
    }
    
    /**
     * Show form to create a new product (Admin).
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a new product in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|url',
            'category' => 'nullable|string|max:255',
            'features' => 'nullable|array',
            'price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        Product::create([
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
            'description' => $request->description,
            'image' => $request->image,
            'category' => $request->category ?? 'Uncategorized',
            'features' => $request->features ?? [],
            'price' => $request->price,
            'stock' => $request->stock ?? 0,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    /**
     * Show form to edit an existing product (Admin).
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update an existing product in the database.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|url',
            'category' => 'nullable|string|max:255',
            'features' => 'nullable|array',
            'price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $product->update([
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
            'description' => $request->description,
            'image' => $request->image,
            'category' => $request->category ?? 'Uncategorized',
            'features' => $request->features ?? [],
            'price' => $request->price,
            'stock' => $request->stock ?? 0,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Delete a product from the database.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }

    /**
     * Show a single product (frontend view).
     */
    public function show(Product $product)
    {
        return view('pages.product_show', compact('product'));
    }
}
