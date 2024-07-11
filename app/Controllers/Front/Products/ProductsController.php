<?php

namespace App\Controllers\Front\Products;

use App\Controllers\Front\FrontController;
use App\Models\ProductModel;

class ProductsController extends FrontController
{
    public ProductModel $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }


    public function list () : string
    {
        $products = $this->productModel->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'selectedPage' => 'products',
            'products' => $products,
        ];

        return view('Front/Pages/Products', $data);
    }
}