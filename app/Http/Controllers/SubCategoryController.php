<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $sub_cat = SubCategory::all();
        return response()->json($sub_cat);
    }

    public function insert(Request $request)
    {

        $request->validate([
            'sc_name' => 'required|alpha',
            'c_id' => 'required|numeric',
        ]);

        $sub_cat = new SubCategory();
        $sub_cat->sc_name = $request->sc_name;
        $sub_cat->c_id = $request->c_id;
        $sub_cat->save();

        return response()->json($sub_cat);
    }

    public function read($id)
    {
        $sub_cat = SubCategory::find($id);

        try {
            if (is_null($sub_cat)) {
                throw new \Exception("Sub Category not found.");
            } else {
                return Response()->json($sub_cat);
            }
        } catch (\Exception$e) {
            return response()->json(["Error" => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'sc_name' => 'alpha',
            'c_id' => 'numeric',
        ]);

        $sub_cat = SubCategory::find($id);

        try {
            if (is_null($sub_cat)) {
                throw new \Exception("Sub Category not found for Updation.");
            } else {
                $sub_cat->sc_name = $request->sc_name ?? $sub_cat->sc_name;
                $sub_cat->c_id = $request->c_id ?? $sub_cat->c_id;
                $sub_cat->save();
            }
            return response()->json($sub_cat);
        } catch (\Exception$e) {
            return response()->json(["Error" => $e->getMessage()]);
        }
    }

    public function delete($id)
    {
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
