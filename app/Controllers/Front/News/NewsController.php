<?php

namespace App\Controllers\Front\News;

use App\Controllers\Front\FrontController;

class NewsController extends FrontController
{
    public function list() : string
    {
        $data = [
            'selectedPage' => 'news',
        ];

        return view('Front/Pages/News', $data);
    }
}