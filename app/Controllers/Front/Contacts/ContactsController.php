<?php

namespace App\Controllers\Front\Contacts;

use App\Controllers\Front\FrontController;
use App\Models\StoreModel;

class ContactsController extends FrontController
{
    protected StoreModel $storeModel;

    public function __construct()
    {
        $this->storeModel = new StoreModel();
    }

    public function index() : string
    {
        $data = [
            'selectedPage' => 'contacts',
            'stores' => $this->storeModel->getStoresWithPhones(),
        ];

        return view('Front/Pages/Contacts', $data);
    }
}