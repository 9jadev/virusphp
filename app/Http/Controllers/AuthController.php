<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            "name" => "required|string|min:10",
            "email" => "required|email|unique:users",
            "password" => "required|string"
        ]);
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password) 
        ]);
        
        return response(["message" => "created successfully", "user" => $user, "status" => "success"]);
    }
    public function login (Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $customer = User::where('email', $request->email)->first();
        if ($customer == null) {
            return response(["message" => "Customer Not found.", "status" => "error"], 200);
        }
        if (!Hash::check($request->password, $customer->password)) {
            return response(["message" => "Password not correct.", "status" => "error"], 200);
        }
    
        return response([
            "message" => "Messages Created.",
            'customer' => $customer,
            'accessToken' => $customer->createToken('mobile', ['role:customer'])->plainTextToken,
            'status' => "success"
        ], 200);
    }

    public function getData(){
        $id = Auth::id();
        $user = Auth::user();
        return response(["message" => "Fetched successfully.","userdata" => $user, "status" => "success"]);
    }

    public function logout() {
        $id = Auth::id();
        Auth::user()->tokens()->delete();
        return response(["status" => "loggedout", "message" => "Logout successfully."]);
    }
}
