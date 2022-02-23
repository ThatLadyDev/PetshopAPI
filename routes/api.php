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
Route::post('/user/forgot-password', Authentication\ForgotPasswordController::class);
Route::post('/user/reset-password-token', Authentication\ResetPasswordTokenController::class);

Route::post('/admin/create', Authentication\RegisterController::class)->name('admin.create');
Route::post('/admin/login', Authentication\LoginController::class)->name('admin.login');

Route::group(['middleware' => ['jwt.verify', 'auth:api']], function () {
    /*
     * User URLs
     */
    Route::match(['get', 'head'], '/user/logout', Authentication\LogoutController::class)->name('user.logout');
    Route::put('/user/edit', Account\EditUserController::class);
    Route::delete('/user', Account\DeleteUserController::class);
    Route::match(['get', 'head'], '/user', Account\SingleUserController::class);

    /*
     * Admin URLs
     */
    Route::match(['get', 'head'], '/admin/logout', Authentication\LogoutController::class)->name('admin.logout');
    Route::match(['get', 'head'], '/admin/user-listing', Account\ListUsersController::class); //still needs to be worked on
});

Route::fallback(function (){
    abort(404, 'API resource not found');
});

