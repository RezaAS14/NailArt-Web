<?php namespace App\Models;

use CodeIgniter\Model;

class AccessoriesModel extends Model
{
    protected $table = 'accessories';
    protected $primaryKey = 'id_produk';
    protected $allowedFields = [
        'gambar_produk', 
        'nama_produk', 
        'harga_produk', 
        'diskon', 
        'deskripsi_produk', 
        'stok_tersedia'
    ];
}