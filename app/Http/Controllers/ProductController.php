<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\SubCategory;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $sub_category = SubCategory::all();

        return view('layouts.ecommerce.product.product_crud', compact('products', 'sub_category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('layouts.ecommerce.product.product_insert', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'p_name' => 'required|regex:/^[0-9a-zA-ZÑñ\s]+$/',
            'p_details' => 'required|regex:/^[0-9a-zA-ZÑñ\s]+$/',
            'p_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'p_price' => 'required|numeric',
            'sc_id' => 'required|numeric',
        ]);

        $products = new Product();
        $products->p_name = $request->p_name;
        $products->p_details = $request->p_details;
        $products->p_price = $request->p_price;
        $file = $request->file('p_image');

        if ($request->hasFile('p_image')) {
            $extension = $file->extension();
            $fileName = $products->p_name . '.' . $extension;
            $file->storeAs('/public/product-images', $fileName);
            $products->p_image = $fileName;
        } else {
            $products->p_image = "Image Not Inserted";
        }

        $products->sc_id = $request->sc_id;
        $products->save();

        return redirect('/product/'. $products->sc_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Product::where('sc_id', $id)->get();
        $sub_category = SubCategory::where('sc_id', $id)->get();

        try {
            if (is_null($products)) {
                throw new \Exception("Product not found.");
            } else {
                return view('layouts.ecommerce.product.product_crud', compact('products', 'id', 'sub_category'));
            }
        } catch (\Exception $e) {
            return response()->json(["Error" => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('layouts.ecommerce.product.product_update', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'p_name' => 'regex:/^[0-9a-zA-ZÑñ\s]+$/',
            'p_details' => 'regex:/^[0-9a-zA-ZÑñ\s]+$/',
            'p_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'p_price' => 'numeric',
        ]);

        $products = Product::find($id);

        try {
            if (is_null($products)) {
                throw new \Exception("Product not found for Updation.");
            } else {
                $products->p_name = $request->p_name ?? $products->p_name;
                $products->p_details = $request->p_details ?? $products->p_details;
                $products->p_price = $request->p_price ?? $products->p_price;
                $file = $request->file('p_image');
                
                if ($request->hasFile('p_image')) {
                    $extension = $file->extension();
                    $fileName = $products->p_name . '.' . $extension;
                    $file->storeAs('/public/product-images', $fileName);
                    $products->p_image = $fileName;
                } else {
                    $products->p_image = $products->p_image;
                }
                $products->save();
            }
            return redirect('/product/'. $products->sc_id);
        } catch (\Exception $e) {
            return response()->json(["Error" => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Product::find($id);

        try {
            if (is_null($products)) {
                throw new \Exception("Product not found for Deletion.");
            } else {
                $products->delete();
            }
            return redirect('/product/'. $products->sc_id);
        } catch (\Exception $e) {
            return response()->json(["Error" => $e->getMessage()]);
        }
    }
}