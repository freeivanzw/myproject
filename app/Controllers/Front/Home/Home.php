<?php

namespace App\Controllers\Front\Home;

use App\Controllers\Front\FrontController;
use App\Models\AdvantageModel;
use App\Models\BannerModel;
use App\Models\CategoryModel;
use App\Models\NewsModel;

class Home extends FrontController
{
    protected AdvantageModel $advantageModel;
    protected BannerModel $bannerModel;
    protected CategoryModel $categoryModel;
    protected NewsModel $newsModel;

    public function __construct()
    {
        $this->advantageModel = new AdvantageModel();
        $this->bannerModel = new BannerModel();
        $this->categoryModel = new CategoryModel();
        $this->newsModel = new NewsModel();
    }


    public function index(): string
    {
        $data = [
            'selectedPage' => 'main',
            'banner' => $this->bannerModel->find(1),
            'categories' => $this->categoryModel->findAll(),
            'advantages' => $this->advantageModel->findAll(),
            'news' => $this->newsModel->orderBy('created_at', 'DESC')->limit(3)->findAll(),
        ];

        return view('Front/Pages/Home', $data);
    }
}
