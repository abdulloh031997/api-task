<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class AuthController extends BaseController
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string|confirmed'
        ]);
        $user = User::create([
            'name'=>$fields['name'],
            'email'=>$fields['email'],
            'password'=>bcrypt($fields['password']),
        ]);
        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user'=>$user,
            'token'=>$token
        ];
        return $this->sendResponse($response, 'Auth registr successfully.');
    }
    // public function login(Request $request)
    // {
    //     $fields = $request->validate([
    //         'email'=>'required|string',
    //         'password'=>'required|string'
    //     ]);
    //     $user = User::where('email',$fields['email'])->first();
    //     if(!$user || !Hash::check($fields['password'],$user->password)){
    //         return response([
    //             'massage' => 'Badd request'
    //         ],401);
    //     }
    //     $token = $user->createToken('myapptoken')->accessToken;
    //     $response = [
    //         'user'=>$user,
    //         'token'=>$token
    //     ];
    //     return $this->sendResponse($response, 'Auth login successfully.');
    // }

    public function login(Request $request)
    {
        $login = $request->validate([
            'email'=>'required|string',
            'password'=>'required|string'
        ]);
        if(!Auth::attempt($login)){
            return response([
                'massage' => 'Badd request'
            ],401);
        }
        $token = Auth::user()->createToken('tokenjon')->accessToken;
        $response = [
            'user'=>Auth::user(),
            'token'=>$token
        ];
        return $this->sendResponse($response, 'Auth login successfully.');
    }
    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged out'
        ];
    }
}
