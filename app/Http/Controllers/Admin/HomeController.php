<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
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

    public function getChartOnlyMonth()
    {
        $startDate = Carbon::parse()->startOfMonth();
        $endDate = Carbon::parse()->endOfMonth();


        $query = Order::orderBy('updated_at')
            ->whereBetween('updated_at', [$startDate, $endDate])
            ->where('status', 'success')
            ->select('updated_at', 'total');

        $revenueData = $query->get();

        $labels = $revenueData->pluck('updated_at')->map(function ($date) {
            return Carbon::parse($date)->format('d/m/y H:i');
        })->toArray();
        $data = $revenueData->pluck('total')->toArray();


        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }

    public function filterGetChartOnlyMonth(Request $request)
    {
        $validator = $request->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date|after:startDate',
        ]);

        $startDate = $validator['startDate'];
        $endDate = $validator['endDate'];

        $query = Order::orderBy('updated_at')
            ->whereBetween('updated_at', [$startDate, $endDate])
            ->where('status', 'success')
            ->select('updated_at', 'total');

        $revenueData = $query->get();

        $labels = $revenueData->pluck('updated_at')->map(function ($date) {
            return Carbon::parse($date)->format('d/m/y H:i');
        })->toArray();
        $data = $revenueData->pluck('total')->toArray();

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }

    public function getRevenueByYear()
    {
        $year = Carbon::now()->year; // Năm hiện tại

        $query = Order::whereYear('updated_at', $year)
            ->selectRaw('MONTH(updated_at) as month, SUM(total) as revenue')
            ->groupBy('month')
            ->orderBy('month')
            ->where('status', 'success')
            ->get();

        $labels = [];
        $data = [];

        foreach ($query as $item) {
            $labels[] = Carbon::createFromDate($year, $item->month, 1)->format('M');
            $data[] = $item->revenue;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }

    public function filterGetRevenueByYear(Request $request)
    {
        $year = $request->input('year');
        $query = Order::whereYear('updated_at', $year)
            ->selectRaw('MONTH(updated_at) as month, SUM(total) as revenue')
            ->groupBy('month')
            ->orderBy('month')
            ->where('status', 'success')
            ->get();

        $labels = [];
        $data = [];
        foreach ($query as $item) {
            $labels[] = Carbon::createFromDate($year, $item->month, 1)->format('M');
            $data[] = $item->revenue;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }

    public function productChartSale()
    {

        $currentMonth = date('m'); // Tháng hiện tại
        $currentYear = date('Y'); // Năm hiện tại

        $revenueProduct = OrderProduct::whereMonth('updated_at', $currentMonth)
            ->whereYear('updated_at', $currentYear)
            ->selectRaw('product_id, COUNT(*) as totalSold')
            ->groupBy('product_id')
            ->orderBy('totalSold', 'desc')
            ->limit(3)
            ->get();

        $totalProductsSold = OrderProduct::whereMonth('updated_at', $currentMonth)
            ->whereYear('updated_at', $currentYear)
            ->count();
        foreach ($revenueProduct as $product) {
            $data[] = ($product->totalSold / $totalProductsSold) * 100;
            $labels[] = $product->product->name;
        }
        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }

    public function getTopCustomersChart()
    {
        $year = '2023'; // Năm cần thống kê
        $topCustomers = Order::whereYear('updated_at', $year)
            ->selectRaw('user_id, COUNT(*) as totalOrders')
            ->groupBy('user_id')
            ->orderBy('totalOrders', 'desc')
            ->get();

        $data = [];
        $labels = [];
        foreach ($topCustomers as $customer) {
            $data[] = $customer->totalOrders;
            $labels[] = $customer->user->name;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }



    public function getOrderStatusData()
    {
        $orderStatusData = Order::select('status', \DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get();

        $labels = $orderStatusData->pluck('status');
        $data = $orderStatusData->pluck('count');

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }
}
