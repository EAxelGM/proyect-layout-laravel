<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController as User;
use App\Http\Controllers\Api\RecuperarPasswordController as RecuperarPassword;
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

Route::post('send-email-recuperar-password', [RecuperarPassword::class, 'sendEmail']);
Route::post('verify-recuperar-password', [RecuperarPassword::class, 'verifyCode']);

Route::post('profile/change-password', [User::class, 'changePassword']);


Route::resource('user', User::class);
Route::post('user-modificar-imagen', [User::class, 'actualizarImagen']);
/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */
