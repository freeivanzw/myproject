<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsPhotoModel extends Model
{
    protected $table      = 'News_Photos';
    protected $primaryKey = 'photo_id';

    protected $useAutoIncrement = true;
 
    protected $allowedFields = ['name', 'created_at', 'updated_at', 'news_id'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}