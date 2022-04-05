<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::post('/login', [ApiAuthController::class, 'login'])->name('login.api');
    Route::post('/register', [ApiAuthController::class, 'register'])->name('register.api');
    Route::post('/logout', [ApiAuthController::class, 'logout'])->name('logout.api');

    Route::middleware("guest")->group(function (){
        Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPasswordPost']);
        Route::post('/reset-password', [ResetPasswordController::class, "restPasswordPost"]);
    });
});
