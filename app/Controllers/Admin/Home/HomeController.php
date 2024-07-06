<?php

namespace App\Controllers\Admin\Home;

use App\Controllers\Admin\AdminController;

class HomeController extends AdminController
{
    public function index() : string
    {

        return view('Admin/Pages/Home');
    }
}