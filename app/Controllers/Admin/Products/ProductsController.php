<?php

namespace App\Controllers\Admin\Products;

use App\Controllers\Admin\AdminController;
use App\Models\ProductModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Exception;

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
            'image' => [
                'label' => 'Image File',
                'rules' => 'if_exist|uploaded[file]|is_image[file]|mime_in[file,image/jpg,image/jpeg,image/gif,image/png]|max_size[file,2048]',
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back();
        }

        $updateData = [
            'name' => $form['name'],
            'description' => $form['description'],
            'price' => $form['price'],
        ];

        $img = $this->request->getFile('image');

        if (isset($img) && $img->isValid()) {

            $dirPath = FCPATH . 'uploads/products-photo/' . $product['product_id'];

            if (!is_dir($dirPath)) {
                mkdir($dirPath, 0777, true);
            }

            $fileName = $img->getRandomName();
            $img->move($dirPath, $fileName, true);

            $updateData['main_photo'] = $fileName;
        }

        $this->productModel->update($product['product_id'], $updateData);

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

    /**
     * @param int
     */
    public function removeMainPhoto()
    {

        $productId = $this->request->getGet('productId');

        if (empty($productId)) {
            throw new PageNotFoundException('productId must been not null');
        }

        $product = $this->productModel->find($productId);

        if (!$product) {
            throw new PageNotFoundException('product id not found');
        }

        $fielPath = 'uploads/products-photo/' . $product['product_id'] . '/' . $product['main_photo'];
        if (file_exists($fielPath)) {
            unlink($fielPath);
        }

        $product['main_photo'] = null;
        $this->productModel->save($product);

        return redirect()->back();
    }
}
