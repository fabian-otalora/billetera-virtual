<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Model
{
    use HasApiTokens;

    protected $table = 'customers';

    protected $fillable = [
        'identification',
        'name',
        'email',
        'cell_phone'
    ];
}
