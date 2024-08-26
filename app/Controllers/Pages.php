<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home'
        ];

        // echo view('layouts/header', $data);
        // echo view('pages/home');
        // echo view('layouts/footer');

        return view('pages/home', $data);
    }
    
    public function about()
    {
        // return view('pages/about');
        $data = [
            'title' => 'About',
            'test' => ['satu', 'dua', 'tiga'],
        ];
        
        // echo view('layouts/header', $data);
        // echo view('pages/about');
        // echo view('layouts/footer');

        return view('pages/about', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact',
            'alamat' => [ 
                [
                    'tipe' => 'Rumah',
                    'alamat' => 'Jl. abc No. 123',
                    'kota' => 'Bandung',
                ],
                [
                    'tipe' => 'Kantor',
                    'alamat' => 'Jl. abc No. 234',
                    'kota' => 'Bandung',
                ]
            ]
        ];
        
        return view('pages/contact', $data);
    }
}
