<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\View\View;

class FeedBackController extends Controller
{
    public int $itemPage = 10;

    public function index(): View
    {

        $feedbacks = Feedback::query()->orderByDesc('created_at')->paginate($this->itemPage);

        return view('admin.feedbacks.index', compact('feedbacks'));
    }
}
