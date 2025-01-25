<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Wallet;

class CustomerService{

    // Guardar cliente
    public function save($data){

        // Validar si el usuario ya se encuentra registrado
        $validateId = Customer::where('identification','=',$data['identification'])->first();
        if ($validateId) {
            return false;
        }
        // Validar si el usuario ya se encuentra registrado
        $validateEmail = Customer::where('email','=',$data['email'])->first();
        if ($validateEmail) {
            return false;
        }
        // Validar si el usuario ya se encuentra registrado
        $validateCellPhone = Customer::where('cell_phone','=',$data['cell_phone'])->first();
        if ($validateCellPhone) {
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