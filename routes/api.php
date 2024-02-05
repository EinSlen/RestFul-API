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

Route::controller(\App\Http\Controllers\Api\AuthController::class)->group(function (){
    Route::post('login', 'login')->name('login');
    Route::post('register', 'register')->name('register');
    Route::post('logout', 'logout')->name('logout');
    Route::post('refresh', 'refresh')->name('refresh');

});
//gestion des jetons
//modifier class model user
//controller d'authentification (login, register, logout, refresh)
//gérer les roles utilisateur (table role 5 roles)
//relier les roles aux utilisateurs (table pivot)
//mettre en place le controlle d'accès

Route::get('salles', [\App\Http\Controllers\Api\SalleController::class, 'index'])->name("salles.index")
    ->middleware('auth:api', 'role:'.\App\Models\Role::VISITEUR)->name("salles.show");
Route::get('salles/{id}', [\App\Http\Controllers\Api\SalleController::class, 'show'])->where("id","^[0-9]+$")
    ->middleware('auth:api', 'role:'.\App\Models\Role::VIEW_SALLE)->name("salles.show");

Route::post('salles', [\App\Http\Controllers\Api\SalleController::class, 'store'])
    ->middleware('auth:api', 'role:'.\App\Models\Role::CREATE_SALLE)->name("salles.store");

Route::put('salles/{id}', [\App\Http\Controllers\Api\SalleController::class, 'update'])
    ->middleware('auth:api', 'role:'.\App\Models\Role::EDIT_SALLE)->name("salles.update");
Route::delete('salles/{id}', [\App\Http\Controllers\Api\SalleController::class, 'destroy'])
    ->middleware('auth:api', 'role:'.\App\Models\Role::ADMIN)->name("salles.delete");

//Route::apiResource('salles', SalleController::class);
