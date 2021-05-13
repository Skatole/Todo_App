<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
public function register(Request $request)
{
    $v = Validator::make($request->all(), [
        'email' => 'required|email|unique:users',
        'password'  => 'required|min:3|confirmed',
    ]);
    if ($v->fails())
    {
        return response()->json([
            'status' => 'error',
            'errors' => $v->errors()
        ], 422);
    }
    $user = new User;
    $user->email = $request->email;
    $user->password = bcrypt($request->password);
    $user->save();
    return response()->json(['status' => 'success'], 200);
}
}
