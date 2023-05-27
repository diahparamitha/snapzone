<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class LandingController extends Controller
{
    public function index() {
        return view('pengguna.index',[
            'products' => Product::all(),
            'categories' => Category::all()
        ]);
    }
}
