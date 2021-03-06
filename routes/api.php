<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\DownloadController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\FileManagerController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\VerifyEmailController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Auth\EmailVerificationController;

// auth
Route::post('register', RegisterController::class);
Route::post('login', LoginController::class);
Route::post('forgot-password', ForgotPasswordController::class);
Route::post('reset-password', ResetPasswordController::class);

Route::group(['middleware' => 'auth:sanctum'], function () {
    // auth
    Route::post('logout', LogoutController::class);
    Route::post('email/verification-notification', EmailVerificationController::class);
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)->name('verify');
    Route::get('user', function (Request $request) { return $request->user(); });

    Route::get('roles', [RoleController::class, 'index'])->name('api.roles.index');
    Route::get('permissions', [PermissionController::class, 'index'])->name('api.permissions.index');
    Route::get('menus', [MenuController::class, 'index'])->name('api.menus.index');
    Route::get('menus-select', [MenuController::class, 'menuSelect'])->name('api.menus.select');
    Route::get('users', [UserController::class, 'index'])->name('api.users.index');
    Route::get('file-managers', [FileManagerController::class, 'index'])->name('api.fileManagers.index');

    Route::post('download', DownloadController::class);
});
