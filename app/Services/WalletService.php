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
            $wallet = new Wallet();
            $wallet->customer_id = $customer->id;
            $wallet->money = $data['money'];
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