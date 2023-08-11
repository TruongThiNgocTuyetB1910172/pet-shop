<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\View\View;

class ServiceContronller extends Controller
{
    public int $itemPerPage = 8 ;

    public function index(): View
    {
        $services = Service::query()->orderByDesc('created_at')->paginate($this->itemPerPage);
        return view('client.service.list',compact('services'));
    }
}
