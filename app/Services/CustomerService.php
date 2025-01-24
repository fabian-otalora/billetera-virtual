<?php

namespace App\Services;

use App\Models\Customer;

class CustomerService{

    // Guardar cliente
    public function save($data){
        $customer = new Customer();
        $customer->identification = $data['identification'];
        $customer->name = $data['name'];
        $customer->email = $data['email'];
        $customer->cell_phone = $data['cell_phone'];
        $customer->save();

        return $customer;
    }
}