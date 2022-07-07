<?php

use App\Http\Controllers\Api\Equipment_type_Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EquipmentController;

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

Route::apiResource('equipment', EquipmentController::class)->middleware('auth:sanctum');
Route::get('/api/equipment/{id}', 'EquipmentController@store');

Route::post('auth/register', [AuthController::class, 'createUser']);
Route::post('auth/login', [AuthController::class, 'loginUser'])->name('login');

Route::get('/search', [EquipmentController::class, 'search'])->name('search');


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('auth/logout', [AuthController::class, 'logout']);
});

Route::apiResource('equipment_type', \App\Http\Controllers\Api\Equipment_type_Controller::class);

Route::get('/search', [\App\Http\Controllers\Api\Equipment_type_Controller::class, 'search_t'])->name('search_t');
