<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json([
           'status' => 'Success',
           'users' => $users->toArray()
        ], 200);
    }

    public function show(Request $request, $id)
    {
        $user = User::findOrFail($id);
        return response()->json(
            [
                'status' => 'success',
                'user' => $user->toArray()
            ], 200);
    }
}
