<?php

namespace App\Controllers;

class Coba extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
        // echo "Hello World!";
    }

    public function coba()
    {
        // return view('welcome_message');
        echo "Hello World!";
    }

    public function about($nama, $umur = 15)
    {
        // return view('welcome_message');
        echo "Hello $nama! yang berumur $umur";
    }
}
