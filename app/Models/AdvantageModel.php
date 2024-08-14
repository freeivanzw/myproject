<?php

namespace App\Models;

use CodeIgniter\Model;

class AdvantageModel extends Model 
{
    protected $table = 'Advantages';
    protected $primaryKey = 'advantage_id';
    protected $allowedFields = ['title', 'description', 'image'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}