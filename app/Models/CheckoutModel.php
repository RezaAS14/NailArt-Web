<?php namespace App\Models;

use CodeIgniter\Model;

class CheckoutModel extends Model
{
    // Nama tabel di database Anda (db_nailart.sql)
    protected $table = 'checkout';
    
    // Primary Key
    protected $primaryKey = 'id_checkout';
    
    // Field yang diizinkan untuk diisi
    protected $allowedFields = ['id_user', 'total_harga', 'tanggal_checkout'];

    // Gunakan join di Controller (sudah dilakukan) atau di sini jika mau
}