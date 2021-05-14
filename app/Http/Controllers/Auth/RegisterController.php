<?php

    namespace App\Http\Controllers\Auth;

    use App\Http\Controllers\Controller;
    use App\Models\User;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Validation\ValidationException;

    class RegisterController extends Controller
    {
        public function register(Request $request)
        {
            try {
                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:2', 'confirmed'],
                ]);
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
                $user->assignRole($request->role);
                $user->save();
                return response()->json(['status' => 'success'], 200);

            } catch (Error $error) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $error,
                ]);
            }


        }
    }
