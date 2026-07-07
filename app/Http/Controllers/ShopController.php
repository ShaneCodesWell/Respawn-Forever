<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(): View
    {
        $products = Product::where('is_active', true)
            ->latest()
            ->get();

        return view('shop.index', compact('products'));
    }
}
