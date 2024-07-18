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
        


        dd($this->storeModel->getStoresWithPhones());
    }
}