<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home'
        ];
        echo view('layouts/header', $data);
        echo view('pages/home');
        echo view('layouts/footer');
    }
    
    public function about()
    {
        // return view('pages/about');
        $data = [
            'title' => 'About',
            'test' => ['satu', 'dua', 'tiga']
        ];
        echo view('layouts/header', $data);
        echo view('pages/about');
        echo view('layouts/footer');
    }
}
