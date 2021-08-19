<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(){
        $user = User::all();
        return response()->json($user);
    }

    public function register(Request $request){
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
        ]);

        return response()->json(['user'=>$user,'message'=>'Succefully registered'],200);
    }
}
