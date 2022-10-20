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
        $category = Category::all();
        
        return view('layouts.ecommerce.category.category_crud', compact('category'));
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
        
        $category = new Category();
        $category->c_name = $request->c_name;
        $file = $request->file('c_image');

        if ($request->hasFile('c_image')) {
            $extension = $file->extension();
            $fileName = $category->c_name . '.' . $extension;
            $file->storeAs('/public/category-images', $fileName);
            $category->c_image = $fileName;
        } else {
            $category->c_image = "Image Not Inserted";
        }

        $category->save();

        return redirect('/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);

        try {
            if (is_null($category)) {
                throw new \Exception("Category not found.");
            } else {
                return json_encode($category);
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
        return view('layouts.ecommerce.category.category_update', compact('id'));
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

        $category = Category::find($id);

        try {
            if (is_null($category)) {
                throw new \Exception("Category not found for Updation.");
            } else {
                $category->c_name = $request->c_name ?? $category->c_name;
                $file = $request->file('c_image');

                if ($request->hasFile('c_image')) {
                    $extension = $file->extension();
                    $fileName = $category->c_name . '.' . $extension;
                    $file->storeAs('/public/category-images', $fileName);
                    $category->c_image = $fileName;
                } else {
                    $category->c_image = $category->c_image;
                }

                $category->save();
            }

            return redirect('/category');

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
        $category = Category::find($id);

        try {
            if (is_null($category)) {
                throw new \Exception("Category not found for Deletion.");
            } else {
                $category->delete();
            }
            return redirect('/category');
        } catch (\Exception $e) {
            return json_encode(["Error" => $e->getMessage()]);
        }
    }
}