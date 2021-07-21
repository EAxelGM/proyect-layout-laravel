<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController as User;
use App\Http\Controllers\Api\JWTController as JWT;

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


Route::post('register', [JWT::class, 'register']);
Route::post('login', [JWT::class, 'authenticate']);


Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('profile', [JWT::class, 'getAuthenticatedUser']);
    Route::post('loggout', [JWT::class, 'loggout']);
});

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */
