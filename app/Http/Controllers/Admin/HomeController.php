<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('admin.layouts.app');
    }
}
