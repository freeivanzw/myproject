<?php

namespace App\Controllers\Admin\Products;

use App\Controllers\Admin\AdminController;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\ProductPhotoModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class ProductsController extends AdminController
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
    public function details(int $id)
    {
        $product = $this->productModel->find($id);
        $photos = $this->productPhotoModel
            ->where('product_id', $id)
            ->select(['photo_id', 'image_url'])
            ->findAll();

        $data = [
            'product' => $product,
            'photos' => $photos,
            'categories' => $this->categoryModel->select('category_id, name')->findAll(),
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

        if (isset($form['category'])) {
            $updateData['category_id'] = $form['category'];
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

        $photos = $this->productPhotoModel->where('product_id', $product['product_id'])->findAll();

        foreach ($photos as $photoItem) {
            $dirPath = FCPATH . 'uploads/product-images/' . $photoItem['product_id'] . '/' . $photoItem['image_name'];

            unlink($dirPath);

            $this->productPhotoModel->delete($photoItem['photo_id']);
        }

        $this->productModel->delete($id);

        return redirect('admin/products');
    }

    public function addPhoto()
    {
        $productId = $this->request->getPost('product_id');
        $productAlt = $this->request->getPost('alt');
        $image = $this->request->getFile('image');

        
        if ($image->isValid() && !$image->hasMoved()) {
            $dirPath = FCPATH . 'uploads/product-images/' . $productId;

            if (!is_dir($dirPath)) {
                mkdir($dirPath, 0777, true);
            }
            
            $newName = $image->getRandomName();
            $image->move($dirPath, $newName, true);

            $imageUrl = base_url('uploads/product-images/' . $productId . '/' . $newName);

            $data = [
                'image_url' => $imageUrl, 
                'alt' => $productAlt,
                'product_id' => $productId,
                'image_name' => $newName,
            ];

            $this->productPhotoModel->save($data);

            return $this->response->setJSON([
                'status' => 'success',
                'productId' => $productId,
                'filePath' => $imageUrl,
            ]);
        }
    }

    public function removePhoto(int $productId, int $photoId)
    {

        $photo = $this->productPhotoModel
            ->where('product_id', $productId)
            ->where('photo_id', $photoId)
            ->find();

        if (!$photo) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'this photo not found',
            ]);
        }
        
        $photoPath = 'uploads/product-images/' . $photo[0]['product_id'] . '/' . $photo[0]['image_name'];
        
        unlink($photoPath);

        $this->productPhotoModel->delete($photo[0]['photo_id']);
        
        return $this->response->setJSON([
            'success' => true,
        ]);;
    }
}
