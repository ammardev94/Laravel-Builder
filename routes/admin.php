<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;


Route::group(['prefix' => 'admin'], function () {

    Route::get('/login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login_attempt'])->name('admin.login.attempt');

    Route::get('/forgot-password', [AuthController::class, 'forgot_password'])->name('admin.forgot.password');
    Route::post('/forgot-password', [AuthController::class, 'forgot_password_attempt'])->name('admin.forgot.password.attempt');

    Route::get('/reset-password/{token}', [AuthController::class, 'reset_password'])->name('admin.reset.password');
    Route::post('/reset-password', [AuthController::class, 'reset_password_attempt'])->name('admin.reset.password.attempt'); 

    Route::group(['middleware'    => 'admin.auth'], function () {

        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    });
});
