<?php

namespace App\Controllers\Admin\News;

use App\Controllers\Admin\AdminController;
use App\Models\NewsModel;
use App\Models\NewsPhotoModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;

class NewsController extends AdminController
{
    protected NewsModel $newsModel;
    protected NewsPhotoModel $newsPhotoModel;

    public function __construct()
    {
        $this->newsModel = new NewsModel();
        $this->newsPhotoModel = new NewsPhotoModel();
    }

    public function list(): string
    {
        $data = [
            'news' => $this->newsModel->orderBy('updated_at', 'DESC')->findAll(),
        ];

        return view('Admin/Pages/News', $data);
    }

    public function create(): RedirectResponse
    {
        $newsData = [
            'title' => null,
            'description' => null,
            'news_text' => null,
        ];
        $this->newsModel->save($newsData);

        return redirect()->back();
    }

    public function edit(int $id): string
    {
        $newsItem = $this->newsModel->find($id);

        $data = [
            'news' => $newsItem,
        ];

        return view('Admin/Pages/NewsDetails', $data);
    }

    public function saveChanges(): RedirectResponse
    {
        $formData = $this->request->getPost();
        $news = $this->newsModel->find($formData['id']);

        if (!$news) {
            throw new PageNotFoundException("nsws id:{$formData['id']} not exist");
        }

        $this->newsModel->update($news['news_id'], $formData);

        return redirect('admin/news');
    }

    public function uploadImage(int $id)
    {
        if (!isset($_GET['CKEditorFuncNum'])) {
            return response()->setStatusCode(400)->setBody('CKEditorFuncNum not found');
        }

        $dir = FCPATH . 'uploads/news-images/' . $id;

        if (!file_exists( $dir ) && !is_dir( $dir )) {
            mkdir($dir, 0777, true);
        }
        
        $img = $this->request->getFile('upload');

        if (!isset($img)) {
            return response()->setStatusCode(400)->setBody('image not found');
        }

        $fileName = $img->getRandomName();

        $img->move($dir, $fileName, true);

        $funcNum = $_GET['CKEditorFuncNum'];
        $url = base_url('uploads/news-images/' . $id . '/' . $fileName);

        $this->newsPhotoModel->save([
            'name' => $fileName,
            'news_id' => $id,
        ]);

        $script = "<script>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', 'Зображення завантажено успішно');</script>";

        return $this->response
                    ->setContentType('text/html')
                    ->setBody($script);   
    }

    public function remove(int $id): RedirectResponse
    {
        $news = $this->newsModel->find($id);

        if (!$news) {
            throw new PageNotFoundException("nsws id:{$id} not exist");
        }

        $photos = $this->newsPhotoModel
                    ->where('news_id', $id)
                    ->findAll();

        if (!empty($photos)) {
            $dir = FCPATH . 'uploads/news-images/' . $id;

            foreach($photos as $photoItem) {
                unlink($dir . '/' . $photoItem['name']);
                $this->newsPhotoModel->delete($photoItem['photo_id']);
            }

            rmdir($dir);
        }

        $this->newsModel->delete($id);

        return redirect()->back();
    }
}