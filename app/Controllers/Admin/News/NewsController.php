<?php

namespace App\Controllers\Admin\News;

use App\Controllers\Admin\AdminController;
use App\Models\NewsModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;

class NewsController extends AdminController
{
    protected NewsModel $newsModel;

    public function __construct()
    {
        $this->newsModel = new NewsModel();
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

        return redirect()->back();
    }

    public function remove(int $id): RedirectResponse
    {
        $news = $this->newsModel->find($id);

        if (!$news) {
            throw new PageNotFoundException("nsws id:{$id} not exist");
        }

        $this->newsModel->delete($id);

        return redirect()->back();
    }
}