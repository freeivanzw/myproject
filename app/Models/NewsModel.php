<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model 
{
    protected $table = 'News';
    protected $primaryKey = 'news_id';
    protected $allowedFields = ['title', 'description', 'news_text'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}