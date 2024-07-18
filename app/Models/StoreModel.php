<?php

namespace App\Models;

use CodeIgniter\Model;

class StoreModel extends Model
{
    protected $table      = 'Stores';
    protected $primaryKey = 'store_id';

    protected $useAutoIncrement = true;

    protected $allowedFields = ['name', 'address', 'email', 'working_hours'];

    public function getStoresWithPhones()
    {
        // в моделі з телефонами зробити метод знайти по ід магазину, потім виклакати той метод тут
    }
}

