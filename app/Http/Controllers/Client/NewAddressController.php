<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewAddressController extends Controller
{
    public function index(): View
    {
        return view('client.new-address.index');
   }
}
