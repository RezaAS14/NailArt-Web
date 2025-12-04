<?php namespace App\Models;

use CodeIgniter\Model;

class GalleryModel extends Model
{
    // Nama tabel di database Anda (db_nailart.sql)
    protected $table = 'gallery';
    
    // Primary Key
    protected $primaryKey = 'id_gallery';
    
    // Field yang diizinkan untuk diisi atau dimodifikasi
    protected $allowedFields = [
        'gambar_gallery', 
        'deskripsi_gallery'
    ];
    
    // Auto Increment ID
    protected $useAutoIncrement = true;
    
    // Tipe data yang dikembalikan
    protected $returnType = 'array';
    
    // Tidak menggunakan Timestamps (created_at/updated_at)
    protected $useTimestamps = false; 
}