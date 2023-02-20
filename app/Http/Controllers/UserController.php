<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        //first of al we will validate that request has all fields properly if invalid or incomplete information then we will throw error
        $request->validate([
            'name' => 'required', 'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);
        //after execution this code then we will create user and assign token
        $user = User::create(['name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->password)]);
        $token = $user->createToken("mytoken")->plainTextToken;
        return response([
            'user' => $user,
            'token' => $token,
            201
        ]);
    }
    public function logout()
    {
        // Auth::logout();
        auth()->user()->tokens()->delete();
        // $user = Auth::user()->token();
        // $user->revoke();
        return response(['message' => "succefully Logged out !!"]);
    }
    public function login(Request $request)
    {
        $request->validate(['email' => 'required|email', 'password' => 'required']);

        $user = User::where('email', $request->email)->first();
        // $response=Hash::check($request->password)
        if(!$user || !Hash::check($request->password, $user->password) ){
            return response([
                'message'=>'Invalid Credentials'
            ], 401);
        }
        
        $token = $user->createToken('mytoken')->plainTextToken;
        return response(["user" => $user, "token" => $token], 200);
        // $token = $user->createToken('myapptoken')->plainTextToken;

        $response= [
            'user' => $user,
            'token'=> $token
        ];
        return response($response, 201);
    }
}
