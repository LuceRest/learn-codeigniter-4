<?php

namespace App\Controllers;

use App\Models\OrangModel;

class Orang extends BaseController
{
    protected $orangModel;
    
    public function __construct()
    {
        $this->orangModel = new OrangModel();
    }
    
    public function index()
    {
        // Mengambil data di url
        $currentPage = $this->request->getVar('page_orang') ? $this->request->getVar('page_orang') : 1;
        
        // Mengambil keyword search
        $keyword = $this->request->getVar('keyword');
        if ( $keyword ) {
            $orang = $this->orangModel->search($keyword);
        } else {
            $orang = $this->orangModel;
        }
        
        // d($this->request->getVar('keyword'));
        
        $data = [
            'title' => 'Daftar Komik',
            // 'orang' => $this->orangModel->findAll(),
            // 'orang' => $this->orangModel->paginate(5, 'orang'),    # paginate(<jumlah per halaman>, <nama tabel>)
            'orang' => $orang->paginate(5, 'orang'),    # paginate(<jumlah per halaman>, <nama tabel>)
            'pager' => $this->orangModel->pager,
            'currentPage' => $currentPage
        ];

        return view('orang/index', $data);
    }

}

