<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function index(): View
    {
        $banners = Banner::all();

        $products = Product::query()->orderByDesc('created_at')->paginate(8);

        return view('client.home', compact('banners', 'products'));
    }
}
