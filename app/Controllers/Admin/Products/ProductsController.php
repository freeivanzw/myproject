<?php

namespace App\Controllers\Admin\Products;

use App\Controllers\Admin\AdminController;
use App\Models\ProductModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class ProductsController extends AdminController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $products = $this->productModel->orderBy('updated_at', 'DESC')->findAll();

        $data = [
            'products' => $products,
        ];

        return view('Admin/Pages/Products', $data);
    }

    public function create()
    {
        $data = [
            'name' => '',
            'description' => '',
            'main_photo' => '',
            'price' => 0,
        ];

        $this->productModel->save($data);

        return redirect()->back();
    }

    /**
     * @param int
     */
    public function edit(int $id)
    {
        $product = $this->productModel->find($id);

        $data = [
            'product' => $product,
        ];

        return view('Admin/Pages/ProductDetails', $data);
    }

    public function saveChanges()
    {
        $form = $this->request->getPost();

        $product = $this->productModel->find($form['id']);

        if (!$product) {
            throw new PageNotFoundException('Product does not exist');
        }

        $rules = [
            'name' => 'required',
            'price' => 'required',
        ];

        $validation = \Config\Services::validation();
        if (!$this->validate($rules)) {
            return redirect()->back();
        }

        $validation->run([
            'name' =>  $form['name'],
            'price' => $form['price'],
        ]);

        $this->productModel->update($product['product_id'], [
            'name' => $form['name'],
            'description' => $form['description'],
            'price' => $form['price'],
        ]);

        return redirect()->back();
    }

    /**
     * @param int
     */
    public function remove(int $id)
    {
        $product = $this->productModel->find($id);

        if (!$product) {
            throw new PageNotFoundException('Product does not exist');
        }

        $this->productModel->delete($id);

        return redirect('admin/products');
    }
}