<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cat_all = Category::all();
        
        return view('layouts.ecommerce.category.category_crud')->with('cat_all');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.ecommerce.category.category_insert');   
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('layouts.ecommerce.category.category_update')->with(compact('id'));
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
            'c_name' => 'alpha',
            'c_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
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