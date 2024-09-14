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