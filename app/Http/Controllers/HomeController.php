<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use Auth;

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
        $view_date = Auth::user()->created_at;
        $date = date('d-m-Y', strtotime($view_date));

        $cat_count = Category::count();
        $cat_all = Category::all();

        $sub_cat_count = SubCategory::count();
        $sub_cat_all = SubCategory::all();

        $product_count = Product::count();
        $product_all = Product::all();

        return view('home')->with(compact('date', 'cat_count', 'cat_all', 
        'sub_cat_count', 'sub_cat_all', 'product_count', 'product_all'));
    }

    public function category()
    {
        return view('layouts.ecommerce.category_crud');
    }

    public function subCategory()
    {
        $view_date = Auth::user()->created_at;
        $date = date('d-m-Y', strtotime($view_date));
        return view('layouts.ecommerce.sub_category_crud')->with(compact('date'));
    }

    public function products()
    {
        return view('layouts.ecommerce.product_crud');
    }
}