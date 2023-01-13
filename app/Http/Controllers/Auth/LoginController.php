<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        if(!$token = auth()->attempt($credentials)){
            return response()->json(['error' => "Incorrect email or password"], 401);
        }

        return response()->json(['token'  => $token]);
    }

    public function refresh()
    {
        try {
            $newToken = auth()->refresh();
        } catch (\PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
        
        return response()->json(['token' => $newToken]);
    }
}
