<?php

namespace App\Controllers\Admin\Login;

use App\Controllers\Admin\AdminController;

class LoginController extends AdminController
{
    public function index() : string
    {
        return view('Admin/Pages/Login');
    }
}