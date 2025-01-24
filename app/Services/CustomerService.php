<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Wallet;

class CustomerService{

    // Guardar cliente
    public function save($data){

        // Validar si el usuario ya se encuentra registrado
        $validateCustomer = Customer::where('identification','=',$data['identification'])->first();

        if ($validateCustomer) {
            return false;
        }

        $customer = new Customer();
        $customer->identification = $data['identification'];
        $customer->name = $data['name'];
        $customer->email = $data['email'];
        $customer->cell_phone = $data['cell_phone'];
        $customer->save();

        $wallet = new Wallet();
        $wallet->customer_id = $customer->id;
        $wallet->money = 0;
        $wallet->save();

        return $customer;
    }
}