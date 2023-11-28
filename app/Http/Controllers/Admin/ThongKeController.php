<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Receipt;
use App\Models\ReceiptDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ThongKeController extends Controller
{
    public function index(): View
    {
        $monthlyRevenues = Order::getAllMonthlyRevenue();

        return view('admin.thongke.index', compact('monthlyRevenues'));
    }
}
