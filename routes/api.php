<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\ConfigurationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/configurations-code', [ConfigurationController::class, 'getCode']);
Route::get('/configurations-general/{id}', [ConfigurationController::class, 'getGeneral']);
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{limit}/{skip}', [UserController::class, 'indexServerSide']);
Route::get('/roles', [RoleController::class, 'index']);
Route::get('/permissions', [PermissionController::class, 'index']);
