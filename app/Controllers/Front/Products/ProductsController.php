<?php

namespace App\Controllers\Front\Products;

use App\Controllers\Front\FrontController;
use App\Models\ProductModel;
use App\Models\ProductPhotoModel;

class ProductsController extends FrontController
{
    protected ProductModel $productModel;
    protected ProductPhotoModel $productPhotoModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->productPhotoModel = new ProductPhotoModel();
    }


    public function list () : string
    {
        $products = $this->productModel->orderBy('created_at', 'DESC')->paginate(8);

        foreach($products as &$product) {
            $result =  $this->productPhotoModel
                ->select('image_url')
                ->where('product_id', $product['product_id'])
                ->first();
            $product['image'] = $result['image_url'] ?? '';
        }

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
        $photos = $this->productPhotoModel
            ->select(['image_url', 'alt'])
            ->where('product_id', $id)
            ->findAll();
        
        $data = [
            'selectedPage' => 'products',
            'product' => $product,
            'photos' => $photos,
        ];

        return view('Front/Pages/ProductsDetails', $data);
    }
}