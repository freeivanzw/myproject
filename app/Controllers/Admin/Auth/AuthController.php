<?php

namespace App\Controllers\Admin\Auth;

use App\Controllers\Admin\AdminController;
use App\Models\AdminModel;

class AuthController extends AdminController
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    public function login() : string
    {
        return view('Admin/Pages/Login');
    }

    public function enter() {
        $data = $this->request->getPost();
        
        if (empty($data['login']) || empty($data['password'])) {
            return redirect()->back()->with('errors', true)->withInput();
        }


        return redirect()->to('admin');
    }

    public function register(): bool
    {
        $data = $this->request->getPost();
       
        if (!$this->validateData($data, [
            'login' => 'required',
            'password' => 'required|min_length[5]',
        ])) {
            return false;
        }

        $this->adminModel->save($data);

        return true;
    }
}