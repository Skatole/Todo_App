<?php

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use \App\Http\Controllers\Auth\LoginController;
    use \App\Http\Controllers\Auth\LogoutController;
    use \App\Http\Controllers\Auth\RegisterController;
    use \App\Http\Controllers\UserController;
    use \App\Http\Controllers\RoleController;
    use \App\Http\Controllers\PostController;


    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
    */

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//  Auth routes
    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
        Route::post('login', [LoginController::class, 'index']);
        Route::post('logout', [LogoutController::class, 'index'])->middleware('jwt.auth', 'jwt.refresh');
        Route::get('user', [UserController::class, 'show']);
        Route::post('register', [RegisterController::class, 'register']);
        Route::get('users', [UserController::class, 'index']);
        Route::get('users/developers', [UserController::class, 'getAllDevelopers']);
        Route::get('users/managers', [UserController::class, 'getAllManagers']);
        Route::post('user/add', [UserController::class, 'addReference']);
        Route::delete('user/remove', [UserController::class, 'removeReference']);
//   Route::get('refresh', [AuthController::class, 'refresh']);
    });

//    Users and references
//    Route::group(['prefix' => 'ref']function () {
//    });

//  Posts
    Route::group(['middleware' => 'auth:api'], function () {

        Route::apiResource('posts', 'App\Http\Controllers\PostController');
        Route::put('posts/updateSwitch', [PostController::class, 'updateSwitch']);
        
    });

//  Roles
    Route::get('roles', [RoleController::class, 'index']);
