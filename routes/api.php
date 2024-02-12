<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SalleController;
use App\Models\Role;
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

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});



Route::get('salles', [SalleController::class, 'index'])->name('salles.index')
    ->middleware(['auth:api', 'role:'.Role::VISITEUR]);;
Route::post('salles', [SalleController::class, 'store'])->name('salles.store')
->middleware(['auth:api', 'role:'.Role::CREATE_SALLE]);
Route::get('salles/{id}', [SalleController::class, 'show'])
    ->where('id', '^[0-9]+$')
    ->name('salles.show')
    ->middleware(['auth:api', 'role:'.Role::VIEW_SALLE]);;
Route::put('salles/{id}', [SalleController::class, 'update'])
    ->where('id', '^[0-9]+$')
    ->name('salles.update')
    ->middleware(['auth:api', 'role:'.Role::EDIT_SALLE]);
Route::delete('salles/{id}', [SalleController::class, 'destroy'])
    ->where('id', '^[0-9]+$')
    ->name('salles.destroy')
    ->middleware(['auth:api', 'role:'.Role::ADMIN]);
