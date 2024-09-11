<?php

namespace App\Controllers\Admin\Category;

use App\Controllers\Admin\AdminController;
use App\Models\CategoryModel;

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

    public function delete()
    {

    }
}