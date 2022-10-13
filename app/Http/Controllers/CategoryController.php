<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class CategoryController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'password' => 'required|min:8|max:100',
        ]);


        $user = new Users();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = $request->password;
    }
}
