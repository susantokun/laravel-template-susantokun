<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ConfigurationController;

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
            Route::put('general/{code}', [ConfigurationController::class, 'generalUpdate'])->name('generalUpdate');

            Route::get('about', [ConfigurationController::class, 'about'])->name('about');
            Route::put('about/{code}', [ConfigurationController::class, 'aboutUpdate'])->name('aboutUpdate');

            Route::get('contact', [ConfigurationController::class, 'contact'])->name('contact');
            Route::put('contact/{code}', [ConfigurationController::class, 'contactUpdate'])->name('contactUpdate');

            Route::get('privacy-policy', [ConfigurationController::class, 'privacyPolicy'])->name('privacyPolicy');
            Route::put('privacy-policy/{code}', [ConfigurationController::class, 'privacyPolicyUpdate'])->name('privacyPolicyUpdate');

            Route::get('term-and-condition', [ConfigurationController::class, 'termAndCondition'])->name('termAndCondition');
            Route::put('term-and-condition/{code}', [ConfigurationController::class, 'termAndConditionUpdate'])->name('termAndConditionUpdate');
        });
    });

    Route::name('accounts.')->group(function() {
        Route::resource('users', UserController::class);
        Route::get('/users-basic', [UserController::class, 'basic'])->name('users.basic');

        Route::group(['middleware' => 'role:superadmin|admin'], function () {
            Route::resource('roles', RoleController::class);
            Route::resource('permissions', PermissionController::class);
        });
    });

});

require __DIR__.'/auth.php';
