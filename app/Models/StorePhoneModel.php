<?php

namespace App\Models;

use CodeIgniter\Model;

class StorePhoneModel extends Model
{
    protected $table      = 'Store_Phones';
    protected $primaryKey = 'phone_id';

    protected $useAutoIncrement = true;

    protected $allowedFields = ['store_id', 'phone'];
}