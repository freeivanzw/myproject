<?php

namespace App\Controllers\Admin\Auth;

use App\Controllers\Admin\AdminController;
use App\Models\AdminModel;
use Exception;

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
        
        try {
            if (empty($data['login']) || empty($data['password'])) {
                throw new Exception();
            }
            
            $admin = $this->adminModel->where('login', $data['login'])->first();

            if (!password_verify($data['password'], $admin['password_hash'])) {
                throw new Exception();
            }

            $this->session->set('admin_id', (int)$admin['admin_id']);

            return redirect()->to('admin');
        } catch (Exception $err) {
            return redirect()->back()->with('errors', true)->withInput();
        }
    }

    public function logout()
    {
        $this->session->remove('admin_id');

        return redirect()->to('/');
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