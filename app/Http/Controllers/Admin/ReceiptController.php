<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Receipt;
use Illuminate\View\View;

class ReceiptController extends Controller
{
    public int $itemPerPage = 10;

    public function index(): View
    {
        $receipts = Receipt::query()->orderByDesc('created_at')->paginate($this->itemPerPage);

        return view('admin.receipts.index', compact('receipts'));
    }

    public function create(): View
    {
        return view('admin.receipts.create');
    }
}
