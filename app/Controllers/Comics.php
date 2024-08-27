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

        // Jika comic tidak ada di tabel
        if ( empty($data['comic']) ) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Comik ' . $slug . ' Not found');
        }

        return view('comic/detail', $data);
    }
    
    public function create() {
        $data = [
            'title' => 'Form Add New Comic'
        ];

        return view('comic/create', $data);
    }

    public function save() {
        // Mengambil request form dengan method get maupun post
        // dd($this->request->getVar());

        $slug = url_title($this->request->getVar('judul'), '-', true);
        
        // Melakukan save data
        $this->comicModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul'),
        ]);

        // Menambahkan flash message melalui session
        session()->setFlashdata('pesan', 'New Comic successfully added');
        
        // Melakukan redirect url
        // return redirect()->to('/comics');
        return redirect()->to(base_url() . '/comics');
    }
    
}

