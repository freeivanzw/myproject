<?php

namespace App\Controllers\Front\Contacts;

use App\Controllers\Front\FrontController;

class ContactsController extends FrontController
{
    public function index() : string
    {
        $data = [
            'selectedPage' => 'contacts',
        ];

        return view('Front/Pages/Contacts', $data);
    }
}