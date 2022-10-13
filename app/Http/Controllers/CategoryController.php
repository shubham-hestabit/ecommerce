<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class CategoryController extends Controller
{
    public function category(Request $request)
    {
        $request->validate([
            'c_name' => 'required'
        ]);

        $user = new Users();

        $user->c_name = $request->c_name;
        $user->save();

        $user->subCategory()->create([
            "c_id" => $user->c_id,
            "sc_name" => $request->sc_name,
        ]);

        // $user->product()->create([
        //     "c_id" => $user->c_id,
        //     "sc_name" => $request->sc_name,
        // ]);
    }

    // public function sub_category(Request $request)
    // {
    //     $request->validate([
    //         'c_name' => 'required'
    //     ]);

    //     $user = new Users();

    //     $user->c_name = $request->c_name;
    //     $user->save();

    //     $user->subCategory()->create([
    //         "c_id" => $user->c_id,
    //         "sc_name" => $request->sc_name,
    //     ]);
    // }
}
