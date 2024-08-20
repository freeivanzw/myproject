<?php

namespace App\Controllers\Admin\Banner;

use App\Controllers\Admin\AdminController;
use App\Models\BannerModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class BannerController extends AdminController
{
    public BannerModel $bannerModel;

    public function __construct()
    {
        $this->bannerModel = new BannerModel();
    }

    public function create()
    {
        $data = [
            'title' => null, 
            'subtitle' => null, 
            'image' => null
        ];

        $this->bannerModel->save($data);

        return redirect()->back();
    }

    public function update()
    {
        $request = $this->request->getPost();
        $banner = $this->bannerModel->find($request['banner_id']);

        if (!$banner) {
            throw PageNotFoundException::forPageNotFound($request['banner_id'] . ' : banner with this id not found');
        }

        $rules = [
            'image' => [
                'label' => 'Image File',
                'rules' => 'if_exist|uploaded[file]|is_image[file]|mime_in[file,image/jpg,image/jpeg,image/gif,image/png]',
            ],
        ];

        if (!$this->validate($rules)) {
            throw PageNotFoundException::forPageNotFound('validation error');
        }

        $banner['title'] = $request['title'];
        $banner['subtitle'] = $request['subtitle'];


        $img = $this->request->getFile('image');

        if (isset($img) && $img->isValid()) {

            $dirPath = FCPATH . 'uploads/banner-photo/' . $banner['banner_id'];

            if (!is_dir($dirPath)) {
                mkdir($dirPath, 0777, true);
            }

            $fileName = $img->getRandomName();
            $img->move($dirPath, $fileName, true);

            $banner['image'] = $fileName;
        }

        $this->bannerModel->save($banner);

        return redirect()->back();
    }


      /**
     * @param int
     */
    public function removeImage(int $bannerId)
    {
        if (empty($bannerId)) {
            throw new PageNotFoundException('bannerId must been not null');
        }

        $banner = $this->bannerModel->find($bannerId);

        if (!$banner) {
            throw new PageNotFoundException('banner id not found');
        }

        $fielPath = 'uploads/banner-photo/' . $banner['banner_id'] . '/' . $banner['image'];
        if (file_exists($fielPath)) {
            unlink($fielPath);
        }

        $banner['image'] = null;
        $this->bannerModel->save($banner);

        return redirect()->back();
    }
}