<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        $cat = User::all();
        return response()->json($cat);
    }

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

    public function read($id)
    {
        $cat = Category::find($id);
    
        try{
            if(is_null($cat)){
                throw new \Exception("User data not found.");
            }
            else{
                return Response()->json($cat);
            }
        }
        catch(\Exception $e){
            return response()->json(["Error" => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'c_name' => 'required|alpha',
        ]);

        $cat = Category::find($id);

        try{
            if(is_null($cat)){
                throw new \Exception("User data not found for Updation.");
            }
            else{
                $cat->c_name = $request->c_name;
                $cat->save();
            }
            return response()->json($cat);
        }
        catch(\Exception $e){  
            return response()->json(["Error" => $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        $cat = Category::find($id);
        $cat->delete();
        return json_encode(['message' => 'Item deleted successfully.']);    
    }
}
