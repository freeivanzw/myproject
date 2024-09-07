<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductPhotoModel extends Model
{
    protected $table      = 'Product_Photos';
    protected $primaryKey = 'photo_id';

    protected $useAutoIncrement = true;

    protected $allowedFields = ['image_url', 'alt', 'created_at', 'updated_at', 'product_id'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}