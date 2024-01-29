<?php

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

Route::get('salles', [\App\Http\Controllers\Api\SalleController::class, 'index'])->name("salles.index");
Route::get('salles/{id}', [\App\Http\Controllers\Api\SalleController::class, 'show'])->where("id","^[0-9]+$")->name("salles.s");

Route::post('salles', [\App\Http\Controllers\Api\SalleController::class, 'store'])->name("salles.store");

Route::put('salles/{id}', [\App\Http\Controllers\Api\SalleController::class, 'update'])->name("salles.update");
Route::delete('salles/{id}', [\App\Http\Controllers\Api\SalleController::class, 'destroy'])->name("salles.delete");
