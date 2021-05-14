<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\Auth\LoginController;
use \App\Http\Controllers\Auth\LogoutController;
use \App\Http\Controllers\Auth\RegisterController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\RoleController;


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

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function() {
   Route::post('login', [LoginController::class, 'index']);
   Route::post('logout', [LogoutController::class, 'index'])->middleware('jwt.auth', 'jwt.refresh');
   Route::get('user', [UserController::class, 'index']);
   Route::post('register', [RegisterController::class, 'register']);
//   Route::get('refresh', [AuthController::class, 'refresh']);
});

Route::group(['middleware' => 'auth:api'], function() {
//    Users
    Route::get('users', [UserController::class, 'index'])->middleware('can:index,user');
});
//    Roles
Route::get('roles', [RoleController::class, 'index']);
