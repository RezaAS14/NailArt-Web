<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AccessoriesModel;
use App\Models\ModelsModel;
use App\Models\GalleryModel;
use App\Models\UserModel;

class AdminController extends BaseController
{
    public function index()
    {
        // 1. Inisialisasi Models
        $accessoriesModel = new AccessoriesModel();
        $modelsModel = new ModelsModel();
        $galleryModel = new GalleryModel();
        $userModel = new UserModel();

        // 2. Ambil Total Data (Count) dari setiap tabel
        $data = [
            'username'          => session()->get('username') ?? 'Admin', // Ambil username dari sesi
            'total_accessories' => $accessoriesModel->countAllResults(), // Hitung baris di tabel accessories
            'total_models'      => $modelsModel->countAllResults(),      // Hitung baris di tabel models
            'total_gallery'     => $galleryModel->countAllResults(),     // Hitung baris di tabel gallery
            'total_users'       => $userModel->countAllResults(),        // Hitung baris di tabel user
        ];

        // 3. Muat View dan kirim data
        return view('admin/dashboard_admin', $data);
    }
}