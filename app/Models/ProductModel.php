<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table      = 'Products';
    protected $primaryKey = 'product_id';

    protected $useAutoIncrement = true;

    protected $allowedFields = ['name', 'description', 'main_photo', 'price', 'category_id'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getWithPhoto()
    {
        return $this->db->table('Products')
                        ->where('Products.product_id', 53)
                        ->join('Product_Photos', 'Products.product_id = Product_Photos.product_id', 'left')
                        ->get()
                        ->getResult();
    }
}