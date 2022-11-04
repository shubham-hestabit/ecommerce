<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cat_count = Category::count();

        $sub_cat_count = SubCategory::count();
        
        $product_count = Product::count();
        
        return view('home')->with(compact('cat_count', 'sub_cat_count', 'product_count'));
    }
}