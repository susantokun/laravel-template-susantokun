<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ConfigurationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('frontend.pages.home');
});

Route::get('/dashboard', function () {
    return view('backend.pages.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
    Route::name('settings.')->group(function() {
        Route::name('configurations.')->prefix('configurations')->group(function() {
            Route::get('general', [ConfigurationController::class, 'general'])->name('general');
            Route::get('about', [ConfigurationController::class, 'about'])->name('about');
            Route::get('contact', [ConfigurationController::class, 'contact'])->name('contact');
            Route::get('privacy-policy', [ConfigurationController::class, 'privacyPolicy'])->name('privacyPolicy');
            Route::get('term-and-condition', [ConfigurationController::class, 'termAndCondition'])->name('termAndCondition');
        });
    });

    Route::name('accounts.')->group(function() {
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');
    });

    Route::get('/users-basic', [UserController::class, 'basic'])->name('users.basic');
});

require __DIR__.'/auth.php';
