<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::all();
        return response()->json($product);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'p_name' => 'required|alpha_num',
            'p_price' => 'required|numeric',
            'sc_id' => 'required|numeric',
        ]);

        $product = new Product();
        $product->p_name = $request->p_name;
        $product->p_price = $request->p_price;
        $product->sc_id = $request->sc_id;
        $product->save();

        return response()->json($product);
    }

    public function read($id)
    {
        $product = Product::find($id);

        try {
            if (is_null($product)) {
                throw new \Exception("Product not found.");
            } else {
                return Response()->json($product);
            }
        } catch (\Exception$e) {
            return response()->json(["Error" => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'p_name' => 'alpha',
            'p_price' => 'numeric',
            'sc_id' => 'numeric',
        ]);

        $product = Product::find($id);

        try {
            if (is_null($product)) {
                throw new \Exception("Product not found for Updation.");
            } else {
                $product->p_name = $request->p_name ?? $product->p_name;
                $product->p_price = $request->p_price ?? $product->p_price;
                $product->sc_id = $request->sc_id ?? $product->sc_id;
                $product->save();
            }
            return response()->json($product);
        } catch (\Exception$e) {
            return response()->json(["Error" => $e->getMessage()]);
        }
    }

    public function delete($id)
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
