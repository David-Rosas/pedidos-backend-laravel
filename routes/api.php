<?php

use App\Http\Controllers\CuentaController;
use App\Http\Controllers\PedidoController;
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

//rutas cuentas
Route::get('/cuentas', [CuentaController::class, 'index']);
Route::post('/cuentas', [CuentaController::class, 'store']);
Route::get('/cuentas/{cuenta}', [CuentaController::class, 'show']);
Route::put('/cuentas/{cuenta}', [CuentaController::class, 'update']);
Route::delete('/cuentas/{cuenta}', [CuentaController::class, 'destroy']);

//rutas pedidos
Route::get('/pedidos', [PedidoController::class, 'index']);
Route::post('/pedidos', [PedidoController::class, 'store']);
Route::get('/pedidos/{pedido}', [PedidoController::class, 'show']);
Route::put('/pedidos/{pedido}', [PedidoController::class, 'update']);
Route::delete('/pedidos/{pedido}', [PedidoController::class, 'destroy']);
