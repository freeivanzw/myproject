<?php

namespace App\Controllers\Admin\Home;

use App\Controllers\Admin\AdminController;
use App\Controllers\Admin\Advantage\AdvantageController;
use App\Models\BannerModel;

class HomeController extends AdminController
{
    public function index() : string
    {

        $advantagesModel = new AdvantageController();
        $bannerModel = new BannerModel();

        $data = [
            'advantages' => $advantagesModel->getAll(),
            'banner' => $bannerModel->find(1),
        ];

        return view('Admin/Pages/Home', $data);
    }
}