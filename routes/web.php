<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
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

        Route::group(['middleware' => 'role:superadmin'], function () {
            Route::resource('menus', MenuController::class);
        });
    });

    Route::name('accounts.')->group(function() {
        Route::get('/users-basic', [UserController::class, 'basic'])->name('users.basic');
        Route::resource('users', UserController::class);
        Route::get('users-export', [UserController::class, 'export'])->name('users.export');
        Route::post('users-import', [UserController::class, 'import'])->name('users.import');
        Route::get('users-import-example', [UserController::class, 'importExample'])->name('users.import.example');

        Route::group(['middleware' => 'role:superadmin|admin'], function () {
            Route::resource('roles', RoleController::class);
            Route::resource('permissions', PermissionController::class);
        });
    });

    Route::get('routes', function () {
        $routeCollection = Route::getRoutes();

        echo "<table style='width:100%'>";
        echo "<tr>";
        echo "<td width='10%'><h4>HTTP Method</h4></td>";
        echo "<td width='10%'><h4>Route</h4></td>";
        echo "<td width='10%'><h4>Name</h4></td>";
        echo "<td width='70%'><h4>Corresponding Action</h4></td>";
        echo "</tr>";
        foreach ($routeCollection as $value) {
            echo "<tr>";
            echo "<td>" . $value->methods()[0] . "</td>";
            echo "<td>" . $value->uri() . "</td>";
            echo "<td>" . $value->getName() . "</td>";
            echo "<td>" . $value->getActionName() . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    });

});

require __DIR__.'/auth.php';
