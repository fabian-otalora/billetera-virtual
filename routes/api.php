<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VirtualWalletController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// Registrar clientes
Route::post('/v1/newCustomer', [VirtualWalletController::class, 'customerRegistration']);
// Recargar billetera virtual
Route::post('/v1/recharge', [VirtualWalletController::class, 'rechargeWallet']);
// Consultar saldo
Route::get('/v1/check', [VirtualWalletController::class, 'checkBalance']);
