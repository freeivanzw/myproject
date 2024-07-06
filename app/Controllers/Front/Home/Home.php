<?php

namespace App\Controllers\Front\Home;

use App\Controllers\Front\FrontController;
use App\Models\NewsModel;


class Home extends FrontController
{
    public function index(): string
    {
        // $news = new NewsModel();

        // dd($news->findAll());

        return view('Front/Pages/Home');
    }
}
