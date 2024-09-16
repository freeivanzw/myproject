<?php

namespace App\Controllers\Admin\File;

use App\Controllers\Admin\AdminController;

class FileController extends AdminController
{
    public function upload()
    {
        $file = $this->request->getFile('upload');
        
        if ($file->isValid() && !$file->hasMoved()) {
            $file->move(FCPATH . 'uploads/article-images');

            return base_url('uploads/article-images/' . $file->getName());
        }

        return json_encode(['uploaded' => 0, 'error' => ['message' => 'File upload failed.']]);
    }
}