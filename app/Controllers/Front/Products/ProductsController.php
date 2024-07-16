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
        $products = $this->productModel->orderBy('created_at', 'DESC')->paginate(8);

        $data = [
            'selectedPage' => 'products',
            'products' => $products,
            'pager' => $this->productModel->pager,
        ];

        return view('Front/Pages/Products', $data);
    }

    public function details (int $id) : string
    {
        $product = $this->productModel->find($id);
        
        $data = [
            'selectedPage' => 'products',
            'product' => $product,
        ];

        return view('Front/Pages/ProductsDetails', $data);
    }
}