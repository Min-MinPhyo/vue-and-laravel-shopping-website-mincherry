<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;

class AuthController extends Controller
{
    public function create(Request $request){
        $rules=[
            'name'=>'required|string|max:100',
            'email'=>'required|string|email|max:100|unique:users',
            'password'=>'required|sring|min:8'


        ];

        $validator=\Validator::make($request->input(),$rules);

        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors()->all()
            ],400);
        }

        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);


        return response()->json([
            'status'=>true,
            'message'=>'User create successfully!',
            'token'=>$user->createToken('API TOKEN')->plainTextToken

        ],200);

    }
        public function login(Request $request){
            $rules=[
                'email'=>'required|string|email|max:100',
                'password'=>'required|string'
            ];

            $validator=Validator::make()

        }

    
}
