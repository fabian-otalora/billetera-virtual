<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VirtualWalletController;


// Registrar clientes
Route::post('/v1/newCustomer', [VirtualWalletController::class, 'customerRegistration']);
// Recargar billetera virtual
Route::post('/v1/recharge', [VirtualWalletController::class, 'rechargeWallet']);
// Consultar saldo
Route::get('/v1/check', [VirtualWalletController::class, 'checkBalance']);
// Pagar
Route::post('/v1/pay', [VirtualWalletController::class, 'pay']);
// Confirmar pago
Route::post('/v1/confirmPayment', [VirtualWalletController::class, 'confirmPayment'])->middleware('auth:sanctum');