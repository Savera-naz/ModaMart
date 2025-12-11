<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{




    public function index()
{
$products = Product::latest()->get();
return view('admin.products.index', compact('products'));
}


    public function create()
{
return view('admin.products.create');
}


    public function store(Request $request)
{
$data = $request->validate([
'name' => 'required|string|max:255',
'description' => 'nullable|string',
'price' => 'required|numeric',
'category' => 'nullable|string|max:100',
'image' => 'nullable|url',
'features' => 'nullable|string',
]);


    $data['features'] = $data['features'] ? array_map('trim', explode(',', $data['features'])) : [];


    Product::create($data);


    return redirect()->route('admin.products.index')->with('success', 'Product created.');
}


    public function edit(Product $product)
{
    $featuresCsv = is_array($product->features) ? implode(', ', $product->features) : '';
    return view('admin.products.edit', compact('product', 'featuresCsv'));
}


public function update(Request $request, Product $product)
{
$data = $request->validate([
'name' => 'required|string|max:255',
'description' => 'nullable|string',
'price' => 'required|numeric',
'category' => 'nullable|string|max:100',
'image' => 'nullable|url',
'features' => 'nullable|string',
]);


$data['features'] = $data['features'] ? array_map('trim', explode(',', $data['features'])) : [];


$product->update($data);


return redirect()->route('admin.products.index')->with('success', 'Product updated.');
}


public function destroy(Product $product)
{
$product->delete();
return back()->with('success', 'Product deleted.');
}




}