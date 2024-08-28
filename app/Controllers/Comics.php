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
        // session();
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
        // session();
        $data = [
            'title' => 'Form Add New Comic',
            // 'validation' => \Config\Services::validation()
            'validation' => false
        ];
        // dd($data);   
        // dd(\Config\Services::validation());

        if ( session('validation') ) {
            $data['validation'] = session('validation')->getErrors();
        }

        return view('comic/create', $data);
    }

    public function save() {
        // Mengambil request form dengan method get maupun post
        // dd($this->request->getVar());

        // Validasi input
        if ( !$this->validate([
            // 'judul' => 'required|is_unique[comic.judul]',
            'judul' => [
                'rules' => 'required|is_unique[comic.judul]',
                'errors' => [
                    'required' => '{field} komik harus diisi.',
                    'is_unique' => '{field} komik sudah terdaftar.'
                ]
            ],
            'penulis' => 'required',
            'penerbit' => 'required',
            'sampul' => 'required',
        ]) ) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url('comics/create'))->withInput()->with('validation', $validation);
        }
        
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
        
        // dd($slug);
        
        // Melakukan redirect url
        // return redirect()->to('/comics');
        return redirect()->to(base_url('comics'));
    }
    
    public function change() {
        dd(\Config\Services::validation());

        return redirect()->to(base_url('comics'));
    }
    
}

