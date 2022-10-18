<?php

namespace App\Http\Controllers\Api;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    
    /**
     * @method for insert new sub categories.
     */
    public function insert(Request $request)
    {

        $validated = $request->validate([
            'sc_name' => 'required|alpha',
            'sc_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'c_id' => 'required|numeric',
        ]);

        $sub_cat = SubCategory::create($validated);

        return response()->json($sub_cat);
    }

    /**
     * @method for view a sub category.
     */
    public function read(Request $request)
    {
        $id = $request->id;
        $sub_cat = SubCategory::find($id);

        try {
            if (is_null($sub_cat)) {
                throw new \Exception("Sub Category not found.");
            } else {
                return Response()->json($sub_cat);
            }
        } catch (\Exception $e) {
            return response()->json(["Error" => $e->getMessage()]);
        }
    }
    
    /**
     * @method for update a sub category.
     */
    public function update(Request $request)
    {
        $request->validate([
            'sc_name' => 'alpha',
            'sc_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'c_id' => 'numeric',
        ]);

        $id = $request->id;
        $sub_cat = SubCategory::find($id);

        try {
            if (is_null($sub_cat)) {
                throw new \Exception("Sub Category not found for Updation.");
            } else {
                $sub_cat->sc_name = $request->sc_name ?? $sub_cat->sc_name;
                $file = $request->file('sc_image') ?? $sub_cat->sc_image;
                $extension = $file->extension();
                $fileName = $cat->c_name . '.' . $extension;
                $file->storeAs('/public/sub-category-images', $fileName);
                $cat->sc_image = $fileName;
                $sub_cat->c_id = $request->c_id ?? $sub_cat->c_id;
                $sub_cat->save();
            }
            return response()->json($sub_cat);
        } catch (\Exception $e) {
            return response()->json(["Error" => $e->getMessage()]);
        }
    }

    /**
     * @method for delete a sub category.
     */
    public function delete(Request $request)
    {
        $id = $request->id;
        $sub_cat = SubCategory::find($id);

        try {
            if (is_null($sub_cat)) {
                throw new \Exception("Sub Category not found for Deletion.");
            } else {
                $sub_cat->delete();
            }
            return response()->json(['message' => 'Sub Category deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(["Error" => $e->getMessage()]);
        }
    }
}
