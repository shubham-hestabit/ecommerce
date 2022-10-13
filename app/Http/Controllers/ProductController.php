<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @method for viewing all Sub categories.
     */
    public function index()
    {
        $product = Product::all();
        return response()->json($product);
    }

    /**
     * @method for insert new product.
     */
    public function insert(Request $request)
    {
        $request->validate([
            'p_name' => 'required|regex:/^[a-zA-ZÑñ\s]+$/',
            'p_price' => 'required|numeric',
            'p_details' => 'required|regex:/^[a-zA-ZÑñ\s]+$/',
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
    public function read($id)
    {
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'p_name' => 'regex:/^[a-zA-ZÑñ\s]+$/',
            'p_details' => 'regex:/^[a-zA-ZÑñ\s]+$/',
            'p_price' => 'numeric',
            'sc_id' => 'numeric',
        ]);

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
