<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get all news for the user dashboard
        $news = News::with('user')
            ->latest()
            ->paginate(12); // Show 12 news per page

        return view('user.dashboard', compact('news'));
    }
}
