<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// use App\Models\SubCategory;

class CategoryController extends Controller
{
    /**
     * @method for insert new categories.
     */
    public function insert(Request $request)
    {
        $request->validate([
            'c_name' => 'required|alpha',
            'c_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $cat = new Category();
        $cat->c_name = $request->c_name;
        $file = $request->file('c_image');
        $extension = $file->extension();
        $fileName = $cat->c_name . '.' . $extension;
        $file->storeAs('/public/category-images', $fileName);
        $cat->c_image = $fileName;
        $cat->save();

        return json_encode($cat);
    }

    /**
     * @method for view a category.
     */
    public function read(Request $request)
    {
        $id = $request->id;
        $cat = Category::find($id);

        try {
            if (is_null($cat)) {
                throw new \Exception("Category not found.");
            } else {
                return json_encode($cat);
            }
        } catch (\Exception $e) {
            return json_encode(["Error" => $e->getMessage()]);
        }
    }

    /**
     * @method for update a category.
     */
    public function update(Request $request)
    {
        $request->validate([
            'c_name' => 'required|alpha',
            'c_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $id = $request->id;
        $cat = Category::find($id);

        try {
            if (is_null($cat)) {
                throw new \Exception("Category not found for Updation.");
            } else {
                $cat->c_name = $request->c_name ?? $cat->c_name;
                $file = $request->file('c_image') ?? $cat->c_image;
                $extension = $file->extension();
                $fileName = $cat->c_name . '.' . $extension;
                $file->storeAs('/public/category-images', $fileName);
                $cat->c_image = $fileName;
                $cat->save();
            }

            return json_encode($cat);

        } catch (\Exception $e) {
            return json_encode(["Error" => $e->getMessage()]);
        }
    }

    /**
     * @method for delete a category.
     */
    public function delete(Request $request)
    {
        $id = $request->id;
        $cat = Category::find($id);

        try {
            if (is_null($cat)) {
                throw new \Exception("Category not found for Deletion.");
            } else {
                $cat->delete();
            }
            return json_encode(['message' => 'Category deleted successfully.']);
        } catch (\Exception $e) {
            return json_encode(["Error" => $e->getMessage()]);
        }
    }
}
