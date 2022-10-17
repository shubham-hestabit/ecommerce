<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * @method for insert new product.
     */
    public function insert(Request $request)
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
        $product->sc_id = $request->sc_id;
        $product->save();

        return response()->json($product);
    }

    /**
     * @method for view a product.
     */
    public function read(Request $request)
    {
        $id = $request->id;
        $product = Product::find($id);

        try {
            if (is_null($product)) {
                throw new \Exception("Product not found.");
            } else {
                return Response()->json($product);
            }
        } catch (\Exception $e) {
            return response()->json(["Error" => $e->getMessage()]);
        }
    }

    /**
     * @method for update a product.
     */
    public function update(Request $request)
    {
        $request->validate([
            'p_name' => 'regex:/^[0-9a-zA-ZÑñ\s]+$/',
            'p_details' => 'regex:/^[0-9a-zA-ZÑñ\s]+$/',
            'p_price' => 'numeric',
            'sc_id' => 'numeric',
        ]);

        $id = $request->id;
        $product = Product::find($id);

        try {
            if (is_null($product)) {
                throw new \Exception("Product not found for Updation.");
            } else {
                $product->p_name = $request->p_name ?? $product->p_name;
                $product->p_details = $request->p_details ?? $product->p_details;
                $product->p_price = $request->p_price ?? $product->p_price;
                $product->sc_id = $request->sc_id ?? $product->sc_id;
                $product->save();
            }
            return response()->json($product);
        } catch (\Exception $e) {
            return response()->json(["Error" => $e->getMessage()]);
        }
    }

    /**
     * @method for delete a product.
     */
    public function delete(Request $request)
    {
        $id = $request->id;
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
