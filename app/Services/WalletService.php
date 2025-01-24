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
}