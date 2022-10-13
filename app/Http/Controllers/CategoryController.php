<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

// use App\Models\SubCategory;

class CategoryController extends Controller
{
    /**
     * @method for viewing all categories.
     */
    public function index()
    {
        $cat = Category::all();

        return response()->json($cat);
    }

    /**
     * @method for insert new categories.
     */
    public function insert(Request $request)
    {
        $request->validate([
            'c_name' => 'required|alpha',
        ]);

        $cat = new Category();
        $cat->c_name = $request->c_name;
        $cat->save();

        return response()->json($cat);
    }

    /**
     * @method for view a category.
     */
    public function read($id)
    {
        $cat = Category::find($id);

        try {
            if (is_null($cat)) {
                throw new \Exception("Category not found.");
            } else {
                return response()->json($cat);
            }
        } catch (\Exception $e) {
            return response()->json(["Error" => $e->getMessage()]);
        }
    }

    /**
     * @method for update a category.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'c_name' => 'required|alpha',
        ]);

        $cat = Category::find($id);

        try {
            if (is_null($cat)) {
                throw new \Exception("Category not found for Updation.");
            } else {
                $cat->c_name = $request->c_name;
                $cat->save();
            }

            return response()->json($cat);
        } catch (\Exception $e) {
            return response()->json(["Error" => $e->getMessage()]);
        }
    }

    /**
     * @method for delete a category.
     */
    public function delete($id)
    {
        $cat = Category::find($id);

        try {
            if (is_null($sub_cat)) {
                throw new \Exception("Category not found for Deletion.");
            } else {
                $cat->delete();
            }
            return response()->json(['message' => 'Category deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(["Error" => $e->getMessage()]);
        }
    }
}
