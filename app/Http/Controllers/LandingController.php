<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class LandingController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('Pengguna.index', compact('products'));
    }

    public function nav_category() {
        $categories = Category::all();
        return view('Layouts.Pengguna.main', compact('categories'));
    }
}
