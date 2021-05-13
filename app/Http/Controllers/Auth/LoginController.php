<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if ($token = $this->guard()->attempt($credentials)) {
            return response()->json([
                'status' => 'success',
                'token' => $token,
            ], 200);
        }
        return response()->json(['error' => 'login_error'], 401);
    }

    private function guard()
    {
        return Auth::guard();
    }
}
