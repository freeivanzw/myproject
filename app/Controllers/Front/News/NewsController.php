<?php

namespace App\Controllers\Front\News;

use App\Controllers\Front\FrontController;
use App\Models\NewsModel;

class NewsController extends FrontController
{
    protected NewsModel $newsModel;

    public function __construct()
    {
        $this->newsModel = new NewsModel();
    }

    public function list() : string
    {
        $news = $this->newsModel->orderBy('created_at', 'DESC')->paginate(8);

        $data = [
            'selectedPage' => 'news',
            'news' => $news,
        ];

        return view('Front/Pages/News', $data);
    }

    public function details(int $id): string
    {
        $newsData = $this->newsModel->find($id);

        $data = [
            'selectedPage' => 'news',
            'news' => $newsData,
        ];

        return view('Front/Pages/NewsDetails', $data);
    }
}