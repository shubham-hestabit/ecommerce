<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_category = SubCategory::all();

        return view('layouts.ecommerce.sub-category.sub_category_crud', compact('sub_category'));
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

        $sub_category = new SubCategory();
        $sub_category->sc_name = $request->sc_name;
        $file = $request->file('sc_image');

        if ($request->hasFile('sc_image')) {
            $extension = $file->extension();
            $fileName = $sub_category->sc_name . '.' . $extension;
            $file->storeAs('/public/sub-category-images', $fileName);
            $sub_category->sc_image = $fileName;
        } else {
            $sub_category->sc_image = "Image Not Inserted";
        }

        $sub_category->c_id = $request->c_id;
        $sub_category->save();

        return redirect('/sub-category/'. $sub_category->c_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sub_category = SubCategory::where('c_id', $id)->get();

        try {
            if (is_null($sub_category)) {
                throw new \Exception("Sub Category not found.");
            } else {
                return view('layouts.ecommerce.sub-category.sub_category_crud',compact('sub_category', 'id'));
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
        return view('layouts.ecommerce.sub-category.sub_category_update', compact('id'));
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
        ]);

        $sub_category = SubCategory::find($id);

        try {
            if (is_null($sub_category)) {
                throw new \Exception("Sub Category not found for Updation.");
            } else {
                $sub_category->sc_name = $request->sc_name ?? $sub_category->sc_name;
                $file = $request->file('sc_image');
                
                if ($request->hasFile('sc_image')) {
                    $extension = $file->extension();
                    $fileName = $sub_category->sc_name . '.' . $extension;
                    $file->storeAs('/public/sub-category-images', $fileName);
                    $sub_category->sc_image = $fileName;
                } else {
                    $sub_category->sc_image = $sub_category->sc_image;
                }

                $sub_category->save();
            }
            return redirect('/sub-category/'. $sub_category->c_id);
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
        $sub_category = SubCategory::find($id);

        try {
            if (is_null($sub_category)) {
                throw new \Exception("Sub Category not found for Deletion.");
            } else {
                $sub_category->delete();
            }
            return redirect('/sub-category/'. $sub_category->c_id);
        } catch (\Exception $e) {
            return response()->json(["Error" => $e->getMessage()]);
        }
    }
}
