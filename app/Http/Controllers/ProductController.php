<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($product_id)
    {
        $product_all = Product::where('sc_id', $product_id)->get();

        return view('layouts.ecommerce.product.product_crud', compact('product_all', 'product_id'));
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
            'p_price' => 'required|numeric',
            'sc_id' => 'required|numeric',
        ]);

        $product = new Product();
        $product->p_name = $request->p_name;
        $product->p_details = $request->p_details;
        $product->p_price = $request->p_price;
        $file = $request->file('p_image');
        if ($request->hasFile('p_image')) {
            $extension = $file->extension();
            $fileName = $product->p_name . '.' . $extension;
            $file->storeAs('/public/product-images', $fileName);
            $product->p_image = $fileName;
        } else {
            $product->p_image = "Null";
        }
        $product->sc_id = $request->sc_id;
        $product->save();

        return redirect('/sub-category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('sc_id', $id)->get();

        try {
            if (is_null($product)) {
                throw new \Exception("Product not found.");
            } else {
                // return view('layouts.ecommerce.product.product_crud', compact('product'));
                return Response()->json($product);
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
            'p_price' => 'numeric',
        ]);

        $product = Product::find($id);

        try {
            if (is_null($product)) {
                throw new \Exception("Product not found for Updation.");
            } else {
                $product->p_name = $request->p_name ?? $product->p_name;
                $product->p_details = $request->p_details ?? $product->p_details;
                $product->p_price = $request->p_price ?? $product->p_price;
                $file = $request->file('p_image');
                if ($request->hasFile('p_image')) {
                    $extension = $file->extension();
                    $fileName = $product->p_name . '.' . $extension;
                    $file->storeAs('/public/product-images', $fileName);
                    $product->p_image = $fileName;
                } else {
                    $product->p_image = $product->p_image;
                }
                $product->save();
            }
            return response()->json($product);
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
        $product = Product::find($id);

        try {
            if (is_null($product)) {
                throw new \Exception("Product not found for Deletion.");
            } else {
                $product->delete();
            }
            return response()->json(['message' => 'Product deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(["Error" => $e->getMessage()]);
        }
    }
}
