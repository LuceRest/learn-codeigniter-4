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
        $comics = $this->comicModel->findAll();

        $data = [
            'title' => 'Daftar Komik',
            'comics' => $comics
        ];

        // $comicModel = new \App\Models\ComicModel();
        // $comicModel = new ComicModel(); 
        // $comics = $this->comicModel->findAll();
        
        return view('comic/index', $data);
    }
    
    
}

