<?php

namespace App\Controllers\Admin\Advantage;

use App\Controllers\Admin\AdminController;
use App\Models\AdvantageModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class AdvantageController extends AdminController
{
    protected AdvantageModel $advantageModel;

    public function __construct()
    {
        $this->advantageModel = new AdvantageModel();
    }

    public function create()
    {
        $data = [
            'title' => null,
            'description' => null,
            'image' => null,
        ];
        $this->advantageModel->save($data);

        return redirect()->back();
    }

    public function remove(int $id)
    {
        if (!$this->advantageModel->find($id)) {
            throw PageNotFoundException::forPageNotFound($id . ': advantage id not found');
        }

        $this->advantageModel->where('advantage_id', $id)->delete();

        return redirect()->back();
    }

    public function edit(int $id)
    {
        $request = $this->request->getPost();

        $advantage = $this->advantageModel->find($id);

        if (!$advantage) {
            throw PageNotFoundException::forPageNotFound($id . ': advantage id not found');
        }

        $rules = [
            'image' => [
                'label' => 'Image File',
                'rules' => 'if_exist|uploaded[file]|is_image[file]|mime_in[file,image/jpg,image/jpeg,image/gif,image/png]|max_size[file,2048]',
            ],
        ];

        $this->validate($rules);

        $img = $this->request->getFile('image');

        if (isset($img) && $img->isValid()) {

            $dirPath = FCPATH . 'uploads/advantage-photo/' . $advantage['advantage_id'];

            if (!is_dir($dirPath)) {
                mkdir($dirPath, 0777, true);
            }

            $fileName = $img->getRandomName();
            $img->move($dirPath, $fileName, true);

            $advantage['image'] = $fileName;
        }

        $advantage['title'] = $request['title'];
        $advantage['description'] = $request['description'];
        $this->advantageModel->save($advantage);

        return redirect()->back();
    }

    public function removeImage()
    {
        $advantageId = $this->request->getGet('id');

        if (empty($advantageId)) {
            throw new PageNotFoundException('id must been not null');
        }

        $advantage = $this->advantageModel->find($advantageId);
        
        if (!$advantage) {
            throw new PageNotFoundException('advantage id not found');
        }

        $fielPath = 'uploads/advantage-photo/' . $advantage['advantage_id'] . '/' . $advantage['image'];
        
        if (file_exists($fielPath)) {
            unlink($fielPath);
        }

        $advantage['image'] = null;
        $this->advantageModel->save($advantage);

        return redirect()->back();
    }

    public function getAll()
    {
        return $this->advantageModel->findAll() ?? [];
    }
}
