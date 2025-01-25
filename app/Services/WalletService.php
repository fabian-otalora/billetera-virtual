<?php

namespace App\Services;

use App\Models\Wallet;
use App\Models\Customer;

class WalletService{

    /**
     * Recargar billetera
     */
    public function recharge($data){

        // Verificar que la cuenta exista
        $customer = Customer::where('identification','=',$data['identification'])
            ->where('cell_phone','=',$data['cell_phone'])
            ->first();

        if ($customer) {
            $wallet = Wallet::where('customer_id','=',$customer->id)->first();
            $money_old = $wallet->money;
            $money_new = $data['money'];
            $wallet->money = $money_old + $money_new;
            $wallet->save();

            return $wallet;
        }else{
            return false;
        }

    }

    /**
     * Consultar saldo
     */
    public function checkBalance($data){
        // Verificar que la cuenta exista
        $customer = Customer::where('identification','=',$data['identification'])
            ->where('cell_phone','=',$data['cell_phone'])
            ->first();

        if ($customer) {
            $wallet = Wallet::select('money')
                ->where('customer_id','=',$customer->id)
                ->first();
            return $wallet;
        }else{
            return false;
        }
    }

    /**
     * Pagar
     */
    public function pay($data){
        // Verificar que la cuenta exista
        $customer = Customer::where('identification','=',$data['identification'])
            ->where('cell_phone','=',$data['cell_phone'])
            ->first();

        if ($customer) {
            $customer->tokens()->delete();
            $authToken = $customer->createToken('auth-token')->plainTextToken;
            return $authToken;
        }else{
            return false;
        }
    }

    /**
     * Confirmar Pago
     */
    public function purchase($data){
        // Verificar que la cuenta exista
        $customer = Customer::where('identification','=',$data['identification'])
            ->where('cell_phone','=',$data['cell_phone'])
            ->first();

        if ($customer) {
            $wallet = Wallet::where('customer_id','=',$customer->id)
                ->first();

            // Si no tiene saldo en la cuenta no puede comprar
            if ($wallet->money <= 0) {
                return false;
            }

            $money = $wallet->money;
            $payment = $data['payment_money'];
            $wallet->money = $money - $payment;
            $wallet->save();
        }else{
            return false;
        }
    }
    
}