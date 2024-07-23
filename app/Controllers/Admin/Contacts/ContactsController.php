<?php

namespace App\Controllers\Admin\Contacts;

use App\Controllers\Admin\AdminController;
use App\Models\StoreModel;

class ContactsController extends AdminController
{
    protected StoreModel $storeModel;

    public function __construct()
    {
        $this->storeModel = new StoreModel();
    }

    public function index()
    {
        $stores = $this->storeModel->getStoresWithPhones();

        $data = [
            'stores' => $stores,
        ];
        
        return view('Admin/Pages/Contacts', $data);
    }

    public function createStore()
    {
        $data = [
            'name' => null,
            'address' => null,
            'email' => null,
            'working_hours' => null
        ];

        $this->storeModel->save($data);

        return redirect()->to('admin/contacts');
    }
}