<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        $categories = Category::all();
       return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $product = new Product();

        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->sku = $request->input('sku');
        $product->stock = $request->input('stock');
        $product->description = $request->input('description');
        $product->original_price = $request->input('original_price');
        $product->selling_price = $request->input('selling_price');
        $product->original_price = $request->input('original_price');
        $product->save();
        return redirect('products')->with('status', "Category Added Successfully");
    }
}
