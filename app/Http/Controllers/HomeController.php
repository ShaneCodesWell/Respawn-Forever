<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(): View
    {
        $videos = Video::where('is_short', false)
            ->latest('published_at')
            ->take(3)
            ->get();

        $shorts = Video::where('is_short', true)
            ->latest('published_at')
            ->take(10)
            ->get();

        return view('home.index', compact('videos', 'shorts'));
    }
}
