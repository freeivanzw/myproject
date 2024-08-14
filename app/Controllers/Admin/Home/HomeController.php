<?php

namespace App\Controllers\Admin\Home;

use App\Controllers\Admin\AdminController;
use App\Controllers\Admin\Advantage\AdvantageController;

class HomeController extends AdminController
{
    public function index() : string
    {

        $advantagesModel = new AdvantageController();

        $data = [
            'advantages' => $advantagesModel->getAll(),
        ];

        return view('Admin/Pages/Home', $data);
    }
}