<?php

namespace App\Controllers\Front\Home;

use App\Controllers\Front\FrontController;

class Home extends FrontController
{
    public function index(): string
    {
        $data = [
            'selectedPage' => 'main',
        ];

        return view('Front/Pages/Home', $data);
    }
}
