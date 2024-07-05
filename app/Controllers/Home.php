<?php

namespace App\Controllers;

use App\Models\NewsModel;


class Home extends BaseController
{
    public function index(): string
    {
        $news = new NewsModel();

        dd($news->findAll());

        return view('welcome_message');
    }
}
