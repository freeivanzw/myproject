<?php

namespace App\Controllers\Front\Products;

use App\Controllers\Front\FrontController;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\ProductPhotoModel;

class ProductsController extends FrontController
{
    protected ProductModel $productModel;
    protected ProductPhotoModel $productPhotoModel;
    protected CategoryModel $categoryModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->productPhotoModel = new ProductPhotoModel();
        $this->categoryModel = new CategoryModel();
    }


    public function list () : string
    {
        $categoryId = $this->request->getGet('category-id');

        if (isset($categoryId)) {
            $products = $this
                ->productModel
                ->where('category_id', $categoryId)
                ->orderBy('created_at', 'DESC')
                ->paginate(8);
        } else {
            $products = $this->productModel->orderBy('created_at', 'DESC')->paginate(8);
        }


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

        if (isset($categoryId)) {
            $selectedCategory = $this->categoryModel->find($categoryId);

            $data['category'] = $selectedCategory['name'];
        }

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