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

Route::post('/user/create', Authentication\RegisterController::class)->name('user.create');
Route::post('/user/login', Authentication\LoginController::class)->name('user.login');

Route::post('/admin/create', Authentication\RegisterController::class)->name('admin.create');
Route::post('/admin/login', Authentication\LoginController::class)->name('admin.login');

//Route::match(['get', 'head'], '/logout', DummyController::class);
//Route::post('/user/reset-password-token', DummyController::class);

Route::group(['middleware' => 'jwt.verify'], function () {
//    Route::post('/order-status/create', OrderStatus\CreateController::class);
    Route::get('/logout', DummyController::class);
});

Route::fallback(function (){
    abort(404, 'API resource not found');
});

