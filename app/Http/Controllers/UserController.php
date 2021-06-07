<?php

    namespace App\Http\Controllers;

    use App\Models\User;
    use Error;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Spatie\Permission\Models\Role;
    use Tymon\JWTAuth\Exceptions\JWTException;
    use Tymon\JWTAuth\Exceptions\TokenExpiredException;
    use Tymon\JWTAuth\Exceptions\TokenInvalidException;


    class UserController extends Controller
    {
        public function __constructor()
        {
            $this->middleware(['auth:api']);
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

        public function getAllDevelopers() {
            $developers = User::whereHas("roles", function($q) {
                $q->where("name", "Developer");
            })->get();
                return response()->json([
                    'developers' => $developers
                    ]);
        }

        public function getAllManagers() {
            $managers = User::whereHas("roles", function($q) {
                $q->where("name", "Manager");
            })->get();
            return response()->json([
               'managers' => $managers
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

//        Reference :

        // public function addReference(User $user)
        // {
        //     Auth::user()->addReference($user);
        //     return response()->json([
        //         'status' => 'success',
        //     ]);
        // }

        // public function removeReference(User $user)
        // {
        //     Auth::user()->removeReference($user);
        //     return response()->json([
        //         'status' => 'success',
        //     ]);
        // }

        // public function getReferredUsers(Request $request)
        // {

        //         return response()->json([
        //             'status' => 'success',
        //             'referredUser' => $referredUser
        //         ]);
        //     }
        // }
//    public function user()
//    {
//        $user = Auth::user()->toArray();
//        return response()->json([
//            'status' => 'success',
//            'data' =>  $user
//        ]);
//    }
    // }

}
