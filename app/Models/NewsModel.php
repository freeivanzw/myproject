<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model 
{
    protected $table = 'news';
    protected $primaryKey = 'news_id';
    protected $allowedFields = ['title', 'description', 'text', 'created_date'];
}