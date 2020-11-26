<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\PayloadFactory;
use Tymon\JWTAuth\JWTManager as JWT;

class UserController extends Controller
{
    //
    public function register(Request $request){

    	$validator = Validator::make($request->json()->all(), [
    		'name' => 'required|string|max:255',
    		'email' => 'required|email|unique:users',
    		'password' => 'required|string|min:8'
    	]);

    	if($validator->fails()){
    		return response()->json($validator->errors()->toJson(), 400);
    	}
    	else{
    		User::create([
    			'name'=> $request->json()->get('name'),
    			'email'=> $request->json()->get('email'),
    			'password'=> Hash::make($request->json()->get('password')),
    		]);

    		return response()->json(201);
    	}

    }

    public function login(Request $request)
    {
        $credentials = $request->json()->all();

        if (! $token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(compact('token'));
    }

    public function getProfile(){
    	if(! $user = JWTAuth::parseToken()->authenticate()){
    		return response()->json(['user not found'], 404);
    	}
    	return response()->json(compact('user'));
    }
}
