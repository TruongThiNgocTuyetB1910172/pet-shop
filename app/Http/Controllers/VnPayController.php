<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VnPayController extends Controller
{
    public function onlineCheckout(Request $request)
    {
        $data = $request->all();
    }
}
