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
        public function index(Request $request)
        {
                $user = $request->user();
                $role = $user->getUserRole();
                return response()->json([
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $role

                ]);
//            try {
//
//            }  catch ( TokenExpiredException $exception ) {
//                return response()->json( [
//                    'error'   => true,
//                    'message' => trans( 'auth.token.expired' )
//
//                ], 401 );
//            } catch ( TokenInvalidException $exception ) {
//                return response()->json( [
//                    'error'   => true,
//                    'message' => trans( 'auth.token.invalid' )
//                ], 401 );
//
//            } catch ( JWTException $exception ) {
//                return response()->json( [
//                    'error'   => true,
//                    'message' => trans( 'auth.token.missing' )
//                ], 500 );
//            } catch (Error $ex) {
//                return response()->json([
//                    'error'   => true,
//                    'message' => $ex
//                ]);
//            }
//            $this->authorize(['index' => $user]);
//            $users = User::all();
//            return response()->json([
//                'status' => 'Success',
//                'users' => $users->toArray()
//            ], 200);
        }

        public function show(User $user)
        {
            $this->authorize(['show' => $user]);

            return response()->json(
                [
                    'status' => 'success',
                    'data' => $user->toArray()
                ], 200);
        }

//    public function user()
//    {
//        $user = Auth::user()->toArray();
//        return response()->json([
//            'status' => 'success',
//            'data' =>  $user
//        ]);
//    }
         }
