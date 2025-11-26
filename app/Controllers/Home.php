<?php

namespace App\Controllers;

class Home extends BaseController
{
    /**
     * Memuat URL Helper untuk memastikan fungsi base_url() dan site_url() tersedia di views.
     */
    public function __construct()
    {
        helper(['url']);
    }

    /**
     * Loads the 'about' view.
     */
    public function about(): string
    {
        return view('about', [
            'title' => 'About Us'
        ]);
    }

    /**
     * Loads the 'daftar' view (likely a registration or list page).
     */
    public function daftar(): string
    {
        return view('daftar');
    }
    public function profil(): string
    {
        return view('profil');
    }
    public function index()
    {
    return view('index', [
        'title' => 'Beranda Nail Art'
    ]);
    }
    public function gallery()
    {
        return view('gallery', [
            'title' => 'Galeri Nail Art'
        ]);
    }

    public function models()
    {
        return view('models', [
            'title' => 'Model Nail Art'
        ]);
    }
    public function accessories()
    {
        return view('accessoris', [
            'title' => 'Aksesoris Nail Art'
        ]);
    }
}