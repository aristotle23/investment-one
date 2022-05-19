<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signup(Request $request){
        $data = $request->validate([
            "name"  => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required"
        ]);
        $data['password'] = Hash::make($data['password']);
        
        $user = User::create($data);
        $token = $user->createToken("admin-token")->plainTextToken;

        return $this->response(["token" => $token, "user" => $user]);
        
    }
    public function signin(Request $request){
        $data = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);
        $user = User::Where("email", $data['email'])->first();
        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return $this->sendFail(401,['msg' => "Provided credentials are incorrect" ]);
        }
        $user->tokens()->delete();
        $token = $user->createToken("admin-token")->plainTextToken;

        return $this->response(["token" => $token, "user" => $user]);
        
    }
}
