<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductContronller extends Controller
{
    public int $itemPerPage = 8 ;
    public function index():View
    {
        $categories = Category::all();
        $products = Product::query()->orderByDesc('created_at')->paginate($this->itemPerPage);
        return  view('client.products.list',compact('products','categories'));
    }
}
