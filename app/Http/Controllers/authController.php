<?php

namespace App\Http\Controllers;

use App\Models\userAuth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{
public function registerUser(Request $request){
// validate fields
    $fields = $request->validate(
    [
        'name'=>'required|string',
        'email'=>'required|string|unique:users,email',
        'password'=>'required|string|confirmed',
    ]);
    // register user
    $user = userAuth::create([
        'name'=>$fields['name'],
        'email'=>$fields['email'],
        'password'=>bcrypt($fields['password'])
    ]);
    // create user token
   $token = $user->createToken('userToken')->plainTextToken;
    $response = [
        'user'=>$user,
        'token'=>$token
    ];
    return response($response,201);
}

public function login(Request $request){
    // validate fields
        $fields = $request->validate(
        [
            'email'=>'required|string',
            'password'=>'required|string',
        ]);
        // check email
        $user = userAuth::where('email',$fields['email'])->first();
        // check password
        if (!$user || !Hash::check($fields['password'],$user->password)) {
           return response(
               ['message'=>'Invalid credentials'],401
           );
        }
        // create user token
       $token = $user->createToken('userToken')->plainTextToken;
        $response = [
            'user'=>$user,
            'token'=>$token
        ];
        return response($response,201);
    }

public function logout(Request $request)
{
   auth()->user()->tokens()->delete();
   return response (['message'=>'Logged out']);
}

}
