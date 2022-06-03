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
    Route::group(['prefix' => '/configurations'], function () {
        Route::get('/general', [ConfigurationController::class, 'general'])->name('configurations.general');
        Route::get('/about', [ConfigurationController::class, 'about'])->name('configurations.about');
        Route::get('/contact', [ConfigurationController::class, 'contact'])->name('configurations.contact');
        Route::get('/privacy-policy', [ConfigurationController::class, 'privacyPolicy'])->name('configurations.privacyPolicy');
        Route::get('/term-and-condition', [ConfigurationController::class, 'termAndCondition'])->name('configurations.termAndCondition');
    });

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users-basic', [UserController::class, 'basic'])->name('users.basic');
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/user-role-permission', [UserController::class, 'userRolePermission'])->name('userRolePermission');
});

require __DIR__.'/auth.php';
