<?php

namespace App\Controllers\Front\News;

use App\Controllers\Front\FrontController;

class NewsController extends FrontController
{
    public function list() : string
    {
        return view('Front/Pages/News');
    }
}