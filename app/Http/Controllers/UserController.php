<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;


class UserController extends Controller
{
    public function __constructor(User $user)
    {
        $this->middleware(['auth:api']);
        $this->user = $user;
    }

    //    For the Admin:
    public function index()
    {
        $user = User::all();
        return response()->json([
            'state' => 'index called',
            'users' => $user,
        ]);
    }

    public function show(Request $request)
    {
        $user = $request->user();
        $role = $user->getUserRole();
        $permissions = $user->getAllPermissionsAttribute();
        return response()->json([
            'user' => $user,
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    public function getAllDevelopers()
    {
        $developers = User::whereHas("roles", function ($q) {
            $q->where("name", "Developer");
        })->get();
        return response()->json([
            'developers' => $developers
        ]);
    }

    public function getAllManagers()
    {
        $managers = User::whereHas("roles", function ($q) {
            $q->where("name", "Manager");
        })->get();
        return response()->json([
            'managers' => $managers
        ]);
    }




    //        Reference :

    public function addDefaultReference(User $user)
    {
        $defaultReference = User::addDefaultReference($user);
        return response()->json([
            'status' => 'success',
            'addedRef' => $defaultReference
        ]);
    }

    public function addUniqueReference(User $user, Post $post)
    {
        $uniqueRef = User::addUniqueReference($user, $post);
        return response()->json([
            'status' => 'success',
            'addedRef' => $uniqueRef
        ]);
    }

    // public function removeReference(User $user)
    // {
    //     Auth::user()->removeReference($user);
    //     return response()->json([
    //         'status' => 'success',
    //     ]);
    // }

    public function getCurrentUserReferences()
    {
        $user = Auth::user();

                foreach($user->reference as $reference) {
                    foreach($user->post as $post) {


                        return response()->json([
                            'user' => $user->reference,
                            'post' => $user->post,
                            'referencedUserPost' =>  $user->referencePost

                        ]);
                    
                    // $permissions = $user->getAllPermissionsAttribute();
                }
            }
    }
}
