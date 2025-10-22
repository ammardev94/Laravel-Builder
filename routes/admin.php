<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PageSectionController;
use App\Http\Controllers\Admin\PageSectionFieldController;

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

        /*
        |--------------------------------------------------------------------------
        | Pages Routes
        |--------------------------------------------------------------------------
        */
        Route::get('/pages', [PageController::class, 'index'])->name('admin.pages.index');
        Route::get('/pages/create', [PageController::class, 'create'])->name('admin.pages.create');
        Route::post('/pages/store', [PageController::class, 'store'])->name('admin.pages.store');
        Route::get('/pages/{id}', [PageController::class, 'show'])->name('admin.pages.show');
        Route::get('/pages/{id}/edit', [PageController::class, 'edit'])->name('admin.pages.edit');
        Route::put('/pages/{id}/update', [PageController::class, 'update'])->name('admin.pages.update');
        Route::delete('/pages/{id}/delete', [PageController::class, 'destroy'])->name('admin.pages.destroy');

        /*
        |--------------------------------------------------------------------------
        | Page Sections Routes
        |--------------------------------------------------------------------------
        */
        Route::get('/pages/{page_id}/sections', [PageSectionController::class, 'index'])->name('admin.pages.sections.index');
        Route::get('/pages/{page_id}/sections/create', [PageSectionController::class, 'create'])->name('admin.pages.sections.create');
        Route::post('/pages/{page_id}/sections/store', [PageSectionController::class, 'store'])->name('admin.pages.sections.store');
        Route::get('/sections/{id}/edit', [PageSectionController::class, 'edit'])->name('admin.pages.sections.edit');
        Route::put('/sections/{id}/update', [PageSectionController::class, 'update'])->name('admin.pages.sections.update');
        Route::delete('/sections/{id}/delete', [PageSectionController::class, 'destroy'])->name('admin.pages.sections.destroy');


        /*
        |--------------------------------------------------------------------------
        | Page Section Fields Routes
        |--------------------------------------------------------------------------
        */
        Route::get('/sections/{section_id}/fields', [PageSectionFieldController::class, 'index'])->name('admin.sections.fields.index');
        Route::get('/sections/{section_id}/fields/create', [PageSectionFieldController::class, 'create'])->name('admin.sections.fields.create');
        Route::post('/sections/{section_id}/fields/store', [PageSectionFieldController::class, 'store'])->name('admin.sections.fields.store');
        Route::get('/fields/{id}/edit', [PageSectionFieldController::class, 'edit'])->name('admin.sections.fields.edit');
        Route::put('/fields/{id}/update', [PageSectionFieldController::class, 'update'])->name('admin.sections.fields.update');
        Route::delete('/fields/{id}/delete', [PageSectionFieldController::class, 'destroy'])->name('admin.sections.fields.destroy');

    });
});
