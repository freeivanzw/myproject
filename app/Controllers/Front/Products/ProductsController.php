<?php

namespace App\Controllers\Front\Products;

use App\Controllers\Front\FrontController;

class ProductsController extends FrontController
{
    public function list () : string
    {
        return view('Front/Pages/Products');
    }
}