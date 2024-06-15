<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\KosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register', [AuthApiController::class, 'register']);
Route::post('login', [AuthApiController::class, 'login']);

Route::group([
    "middleware" => ["auth:api"]
], function () {

    Route::get('profile', [AuthApiController::class, 'profile']);
    Route::get('refresh', [AuthApiController::class, 'refreshToken']);
    Route::get('logout', [AuthApiController::class, 'logout']);
});


Route::get('kos',[KosController::class, 'index']);
Route::get('kos/{id}',[KosController::class, 'show']);
Route::post('kos',[KosController::class, 'store']);
Route::put('kos/{id}',[KosController::class, 'update']);
Route::delete('kos/{id}',[KosController::class, 'destroy']);

// Route::apiResource('kos', KosController::class);