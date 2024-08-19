<?php

namespace App\Controllers\Front\Home;

use App\Controllers\Front\FrontController;
use App\Models\AdvantageModel;

class Home extends FrontController
{
    protected AdvantageModel $advantageModel;

    public function __construct()
    {
        $this->advantageModel = new AdvantageModel();
    }


    public function index(): string
    {
        $data = [
            'selectedPage' => 'main',
            'advantages' => $this->advantageModel->findAll(),
        ];

        return view('Front/Pages/Home', $data);
    }
}
