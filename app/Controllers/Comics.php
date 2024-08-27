<?php

namespace App\Controllers;

use App\Models\ComicModel;

class Comics extends BaseController
{
    protected $comicModel;
    
    public function __construct()
    {
        $this->comicModel = new ComicModel();
    }
    
    public function index()
    {
        // $comics = $this->comicModel->findAll();

        $data = [
            'title' => 'Daftar Komik',
            'comics' => $this->comicModel->getComic()
        ];

        // $comicModel = new \App\Models\ComicModel();
        // $comicModel = new ComicModel(); 
        // $comics = $this->comicModel->findAll();
        
        return view('comic/index', $data);
    }

    public function detail($slug) {
        $data = [
            'title' => 'Detail Comic',
            'comic' => $this->comicModel->getComic($slug)
        ];

        return view('comic/detail', $data);
    }
    
    
}

