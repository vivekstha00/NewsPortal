<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\News;

class DashboardController extends Controller
{
    public function index()
    {
        $news = News::with('user')->latest()->paginate(10);
        return view('user.dashboard', compact('news'));
    }
}
