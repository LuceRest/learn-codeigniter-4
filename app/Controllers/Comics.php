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

    // Method untuk menampilkan detail data
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
    
    // Method untuk menampilkan view untuk menambah data
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

    // Method untuk melakukan simpan data
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
            'sampul' => [
                'rules' => 'max_size[sampul,5120]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                // 'rules' => 'uploaded[sampul]|max_size[sampul,5120]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    // 'uploaded' => 'Pilih gambar cover terlebih dahulu.',
                    'max_size' => 'Ukuran gambar terlalu besar.',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ]) ) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url('comics/create'))->withInput()->with('validation', $validation);
            // return redirect()->to(base_url('comics/create'))->withInput();
        }

        // Ambil gambar
        $fileSampul = $this->request->getFile('sampul');

        // Apabila tidak ada gambar yang diupload
        if ( $fileSampul->getError() == 4 ) {
            $namaSampul = 'default.jpg';
        } else {
            // Generate nama sampul random
            $namaSampul = $fileSampul->getRandomName();
            
            // Pindahkan file ke folder img
            $fileSampul->move('img', $namaSampul);
        }
        

        // Ambil nama file sampul
        // $namaSampul = $fileSampul->getName();
        
        $slug = url_title($this->request->getVar('judul'), '-', true);
        
        // Melakukan save data
        $this->comicModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        // Menambahkan flash message melalui session
        session()->setFlashdata('pesan', 'New Comic successfully added');
        
        // dd($slug);
        
        // Melakukan redirect url
        // return redirect()->to('/comics');
        return redirect()->to(base_url('comics'));
    }

    // Method untuk melakukan delete data
    public function delete($id) {
        // Cari gambar berdasarkan id
        $comic = $this->comicModel->find($id);

        // Cek jika file gambarnya default.jpg
        if ( $comic['sampul'] != 'default.jpg' ) {
            // Menghapus gambar
            unlink('img/' . $comic['sampul']);
        }
        
        // Menghapus data
        $this->comicModel->delete($id);

        // Menambahkan flash message melalui session
        session()->setFlashdata('pesan', 'Data Comic successfully delete');

        return redirect()->to(base_url('comics'));
    }

    // Method untuk menampilkan view untuk edit data
    public function edit($slug) {
        // session();
        $data = [
            'title' => 'Form Edit New Comic',
            // 'validation' => \Config\Services::validation()
            'validation' => false,
            'comic' => $this->comicModel->getComic($slug)
        ];
        // dd($data);   
        // dd(\Config\Services::validation());

        if ( session('validation') ) {
            $data['validation'] = session('validation')->getErrors();
        }

        return view('comic/edit', $data);
    }

    // Method untuk melakukan update data
    public function update($id) {
        // Cek judul sama dengan yg lama atau tidak
        $oldComic = $this->comicModel->getComic($this->request->getVar('slug'));
        if ( $oldComic['judul'] == $this->request->getVar('judul') ) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[comic.judul]';
        }

        // Validasi input
        if ( !$this->validate([
            // 'judul' => 'required|is_unique[comic.judul]',
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} komik harus diisi.',
                    'is_unique' => '{field} komik sudah terdaftar.'
                ]
            ],
            'penulis' => 'required',
            'penerbit' => 'required',
            'sampul' => [
                'rules' => 'max_size[sampul,5120]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                // 'rules' => 'uploaded[sampul]|max_size[sampul,5120]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    // 'uploaded' => 'Pilih gambar cover terlebih dahulu.',
                    'max_size' => 'Ukuran gambar terlalu besar.',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]        
        ]) ) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url('comics/edit/' . $this->request->getVar('slug') ))->withInput()->with('validation', $validation);
        }
        
        $fileSampul = $this->request->getFile('sampul');

        // Cek gambar, apakah tetap gambar lama
        if ( $fileSampul->getError() == 4 ) {
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            // Generate nama sampul random
            $namaSampul = $fileSampul->getRandomName();
            
            // Pindahkan file ke folder img
            $fileSampul->move('img', $namaSampul);

            // Cek gambar lama, apakah pakai default atau tidak
            if ($this->request->getVar('sampulLama') != 'default.jpg') {
                // Hapus file lama
                unlink('img/' . $this->request->getVar('sampulLama'));
            }
        }

        
        $slug = url_title($this->request->getVar('judul'), '-', true);
        
        // Melakukan save data
        $this->comicModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        // Menambahkan flash message melalui session
        session()->setFlashdata('pesan', 'Data Comic successfully edited');
        
        // Melakukan redirect url
        return redirect()->to(base_url('comics'));
    }
    
    
    // public function change() {
    //     dd(\Config\Services::validation());

    //     return redirect()->to(base_url('comics'));
    // }
    
}

