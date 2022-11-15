<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $category_count = Category::count();

        $sub_category_count = SubCategory::count();

        $product_count = Product::count();

        return view('home')->with(compact('category_count', 'sub_category_count', 'product_count'));
    }

    public function userProfile(Request $request)
    {
        $id = auth()->user()->id;
        $user = User::findOrFail(auth()->user()->id);
        $userAddress = json_decode($user->address);
        return view('auth.user_profile', compact('user', 'userAddress'));
    }

    public function updateUserProfile(Request $request)
    {
        try {
            $id = auth()->user()->id;
            $userData = User::findOrFail($id);
            
            $userData->name = $request->name ?? $userData->name;
            $userData->email = $request->email ?? $userData->email;
            $userData->phone = $request->phone ?? $userData->phone;
            $file = $request->file('user_img');
            
            if ($request->hasFile('user_img')) {
                $extension = $file->extension();
                $fileName =  $userData->name . '.' . $extension;
                $file->storeAs('/public/user-images', $fileName);
                $userData->profile_pic = $fileName;
            } else {
                $userData->profile_pic = $userData->profile_pic;
            }
            $userData->address = json_encode([
                'street' => $request->street ?? '',
                'city' => $request->city ?? '',
                'state' => $request->state ?? '',
                'zipcode' => $request->zipCode ?? '',
            ]);
            $userData->save();
            session()->flash('success', "User Data Updated Successfully.");
            return back();
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return back();
        }
    }
}
