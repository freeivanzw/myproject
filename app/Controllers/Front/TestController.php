<?php 

namespace App\Controllers\Front;

class TestController extends FrontController
{
    public function index()
    {
        $productModel = new \App\Models\ProductModel();

        echo '<pre>';
        print_r($productModel->getWithPhoto());
        echo '</pre>';
    }
}