<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\View\View;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(): View
    {
        $featured = BlogPost::where('is_featured', true)
            ->latest('published_at')
            ->first();
 
        $posts = BlogPost::when($featured, fn ($query) => $query->whereKeyNot($featured->id))
            ->latest('published_at')
            ->get();
 
        return view('blog.index', compact('featured', 'posts'));
    }
 
    public function show(BlogPost $blogPost): View
    {
        $related = BlogPost::where('id', '!=', $blogPost->id)
            ->latest('published_at')
            ->take(3)
            ->get();
 
        return view('blog.show', compact('blogPost', 'related'));
    }
}
