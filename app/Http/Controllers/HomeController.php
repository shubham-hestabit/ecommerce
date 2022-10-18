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

        $sub_cat_count = SubCategory::count();
        
        $product_count = Product::count();
        
        return view('home')->with(compact('date', 'cat_count', 'sub_cat_count', 'product_count'));
    }

    public function category()
    {
        $view_date = Auth::user()->created_at;
        $date = date('d-m-Y', strtotime($view_date));
        
        $cat_all = Category::all();
        
        return view('layouts.ecommerce.category.category_crud')->with(compact('date', 'cat_all'));
    }
    
    public function subCategory()
    {
        $view_date = Auth::user()->created_at;
        $date = date('d-m-Y', strtotime($view_date));
        
        $sub_cat_all = SubCategory::all();
        
        return view('layouts.ecommerce.sub_category_crud')->with(compact('date', 'sub_cat_all'));
    }
    
    public function products()
    {
        $view_date = Auth::user()->created_at;
        $date = date('d-m-Y', strtotime($view_date));

        $product_all = Product::all();
        
        return view('layouts.ecommerce.product_crud')->with(compact('date', 'product_all'));
    }

    public function categoryInsert()
    {
        $view_date = Auth::user()->created_at;
        $date = date('d-m-Y', strtotime($view_date));

        return view('layouts.ecommerce.category.category_insert')->with(compact('date'));
    }

    public function categoryUpdate()
    {
        $view_date = Auth::user()->created_at;
        $date = date('d-m-Y', strtotime($view_date));

        return view('layouts.ecommerce.category.category_update')->with(compact('date'));
    }

    public function subCategoryInsert()
    {
        $view_date = Auth::user()->created_at;
        $date = date('d-m-Y', strtotime($view_date));

        return view('layouts.ecommerce.sub-category.sub_category_insert')->with(compact('date'));
    }

    public function subCategoryUpdate()
    {
        $view_date = Auth::user()->created_at;
        $date = date('d-m-Y', strtotime($view_date));

        return view('layouts.ecommerce.sub-category.sub_category_update')->with(compact('date'));
    }

    public function productInsert()
    {
        $view_date = Auth::user()->created_at;
        $date = date('d-m-Y', strtotime($view_date));

        return view('layouts.ecommerce.product.product_insert')->with(compact('date'));
    }

    public function productUpdate()
    {
        $view_date = Auth::user()->created_at;
        $date = date('d-m-Y', strtotime($view_date));

        return view('layouts.ecommerce.product.product_update')->with(compact('date'));
    }
}