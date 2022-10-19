<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($cat_id)
    {
        $sub_categories = SubCategory::where('c_id',$cat_id)->get();

        return view('layouts.ecommerce.sub-category.sub_category_crud', compact('sub_categories','cat_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
    return view('layouts.ecommerce.sub-category.sub_category_insert', compact('id'));
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
            'sc_name' => 'required|alpha',
            'sc_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'c_id' => 'required|numeric',
        ]);

        $sub_cat = new SubCategory();
        $sub_cat->sc_name = $request->sc_name;
        $file = $request->file('sc_image');
        $extension = $file->extension();
        $fileName = $sub_cat->sc_name . '.' . $extension;
        $file->storeAs('/public/sub-category-images', $fileName);
        $sub_cat->sc_image = $fileName;
        $sub_cat->c_id = $request->c_id;
        $sub_cat->save();

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
        $sub_cat = SubCategory::where('c_id', $id)->get();
        
        try {
            if (is_null($sub_cat)) {
                throw new \Exception("Sub Category not found.");
            } else {
                return $id;
                // return view('layouts.ecommerce.sub-category.sub_category_crud',compact('sub_cat','id'));
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
        return view('layouts.ecommerce.sub-category.sub_category_update')->with(compact('id'));
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
            'sc_name' => 'alpha',
            'sc_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'c_id' => 'numeric',
        ]);

        $sub_cat = SubCategory::find($id);

        try {
            if (is_null($sub_cat)) {
                throw new \Exception("Sub Category not found for Updation.");
            } else {
                $sub_cat->sc_name = $request->sc_name ?? $sub_cat->sc_name;
                $file = $request->file('sc_image') ?? $sub_cat->sc_image;
                $extension = $file->getClientOriginalExtension();
                $fileName = $sub_cat->sc_name . '.' . $extension;
                $file->storeAs('/public/sub-category-images', $fileName);
                $sub_cat->sc_image = $fileName;
                $sub_cat->save();
            }
            return response()->json($sub_cat);
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
