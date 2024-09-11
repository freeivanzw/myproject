<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'Categories';
    protected $primaryKey = 'category_id';
    protected $allowedFields = ['name'];
}