<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $newOrders = Order::where('status', 'pending')->count();

        $allOrders = Order::all()->count();
        $successOrders = Order::where('status', 'success')->count();

        $bounceRate = round(($successOrders / $allOrders), 2) * 100;

        $users = User::all()->count();

        $monthlyRevenue = Order::getMonthlyRevenue();

        $date = Carbon::now();
        $month = $date->month;


        return view('admin.dashboard', compact('newOrders', 'bounceRate', 'users', 'monthlyRevenue', 'month'));
    }

    public function shipperPage(): View
    {
        return view('shipper.layouts.app');
    }

    public function chart()
    {
        $revenueData = Order::orderBy('id')->select('created_at', 'total')->get();

        $labels = $revenueData->pluck('created_at')->toArray();
        $data = $revenueData->pluck('total')->toArray();

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }
}
