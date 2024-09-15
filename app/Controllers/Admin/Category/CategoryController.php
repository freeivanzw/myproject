<?php

namespace App\Controllers\Admin\Category;

use App\Controllers\Admin\AdminController;
use App\Models\CategoryModel;
use CodeIgniter\Files\Exceptions\FileNotFoundException;

class CategoryController extends AdminController
{
    protected CategoryModel $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function list()
    {
        $categories = $this->categoryModel->orderBy('category_id', 'DESC')->findAll();

        $data = [
            'categories' => $categories,
        ];

        return view('Admin/Pages/CategoriesList', $data);
    }

    public function create()
    {
        $this->categoryModel->save([
            'name' => '',
            'image' => '',
        ]);
        
        return redirect()->back();
    }

    public function edit()
    {
        $categoryId = $this->request->getPost('id');

        $category = $this->categoryModel->find($categoryId);

        if (!$category) {
            throw new FileNotFoundException('id not found');
        }

        $category['name'] = $this->request->getPost('name');

        $image = $this->request->getFile('image');

        if ($image) {
            $dirPath = FCPATH . 'uploads/category-photo/' . $category['category_id'];

            if (!is_dir($dirPath)) {
                mkdir($dirPath, 0777, true);
            }

            $fileName = $image->getRandomName();
            $image->move($dirPath, $fileName, true);

            $category['image'] = $fileName;
        }

        $this->categoryModel->save($category);

        return redirect()->back();
    }

    public function removePhoto(int $id)
    {
        $category = $this->categoryModel->find($id);

        if (!$category && !isset($category['image'])) {
            throw new FileNotFoundException('id not found');
        }

        $dirPath = FCPATH . 'uploads/category-photo/' . $category['category_id'];
        $filePath = $dirPath . '/' . $category['image'];

        unlink($filePath);
        rmdir($dirPath);

        $category['image'] = '';

        $this->categoryModel->save($category);

        return redirect()->back();
    }

    public function delete(int $id)
    {
        if (!$this->categoryModel->find($id)) {
            throw new FileNotFoundException('id not found');
        }

        $this->categoryModel->delete($id);

        return response()->setJSON([
            'success'=> true,
            'message' => 'category has deleted',
        ]);
    }
}