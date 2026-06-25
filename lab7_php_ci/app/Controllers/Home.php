<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $title = 'Selamat Datang!';
        $content = 'Ini adalah Portal Berita berbasis CodeIgniter 4.';
        return view('home', compact('title', 'content'));
    }
}