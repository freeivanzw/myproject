<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table      = 'Products';
    protected $primaryKey = 'product_id';

    protected $useAutoIncrement = true;

    protected $allowedFields = ['name', 'description', 'main_photo', 'price'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}