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
        $cat_count = Category::count();

        $sub_cat_count = SubCategory::count();
        
        $product_count = Product::count();
        
        return view('home')->with(compact('cat_count', 'sub_cat_count', 'product_count'));
    }

    public function category()
    {
       
        $cat_all = Category::all();
        
        return view('layouts.ecommerce.category.category_crud')->with(compact('cat_all'));
    }
    
    public function subCategory()
    {
        
        $sub_cat_all = SubCategory::all();
        
        return view('layouts.ecommerce.sub_category_crud')->with(compact('sub_cat_all'));
    }
    
    public function products()
    {
        $product_all = Product::all();
        
        return view('layouts.ecommerce.product_crud')->with(compact('product_all'));
    }

    public function productInsert()
    {
        return view('layouts.ecommerce.product.product_insert');
    }

    public function productUpdate()
    {
        return view('layouts.ecommerce.product.product_update');
    }
}