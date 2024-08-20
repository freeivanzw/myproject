<?php

namespace App\Controllers\Front\Home;

use App\Controllers\Front\FrontController;
use App\Models\AdvantageModel;
use App\Models\BannerModel;

class Home extends FrontController
{
    protected AdvantageModel $advantageModel;
    protected BannerModel $bannerModel;

    public function __construct()
    {
        $this->advantageModel = new AdvantageModel();
        $this->bannerModel = new BannerModel();
    }


    public function index(): string
    {
        $data = [
            'selectedPage' => 'main',
            'advantages' => $this->advantageModel->findAll(),
            'banner' => $this->bannerModel->find(1),
        ];

        return view('Front/Pages/Home', $data);
    }
}
