<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ReembolsoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\SearchController;


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

Route::post('/cliente', [clienteController::class, 'store']);
//Route::middleware('auth:api')->group(
//function () {
Route::post('/search', [SearchController::class, 'search']);
Route::get('/cliente', [ClienteController::class, 'lista']);
Route::put('/cliente/{id}', [clienteController::class, 'update']);
Route::get('/cliente/{id}', [clienteController::class, 'show']);
Route::delete('/cliente/{id}', [clienteController::class, 'delete']);
Route::post('/conectar', [UsuarioController::class, 'authenticar']);
Route::delete('/usuario/{id}', [UsuarioController::class, 'delete']);
Route::post('/registrar', [UsuarioController::class, 'store']);
Route::put('/usuario/{id}', [UsuarioController::class, 'update']);
Route::get('/usuario/{id}', [UsuarioController::class, 'show']);
Route::get('/usuario', [UsuarioController::class, 'lista']);
   // }
//);
