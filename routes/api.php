<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::get('/user', DummyController::class);

Route::post('/user/create', Authentication\RegisterController::class);
Route::post('/user/login', Authentication\LoginController::class);
//Route::match(['get', 'head'], '/logout', DummyController::class);
//Route::post('/user/reset-password-token', DummyController::class);

//Route::group(['middleware' => 'jwt.verify'], function () {
//    Route::get('user', DummyController::class);
//});

Route::fallback(function (){
    abort(404, 'API resource not found');
});

//| GET|HEAD  | api/v1/user                      |
//| DELETE    | api/v1/user                      |
//| GET|HEAD  | api/v1/user/orders               |
//| PUT       | api/v1/user/edit
