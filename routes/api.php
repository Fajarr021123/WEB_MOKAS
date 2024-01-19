<?php

use App\Http\Controllers\ApiMotorController;
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

Route::get('motor', [ApiMotorController::class, 'index']);
Route::get('motor/{id}', [ApiMotorController::class, 'show']);
Route::get('search', [ApiMotorController::class, 'search']);
Route::post('motor', [ApiMotorController::class, 'store']);
Route::put('motor/update/{id}', [ApiMotorController::class, 'update']); // Rute untuk metode update
Route::delete('motor/{id}', [ApiMotorController::class, 'destroy']); // Rute untuk metode destroy
