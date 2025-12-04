<?php namespace App\Models;

use CodeIgniter\Model;

class ModelsModel extends Model
{
    protected $table = 'models';
    protected $primaryKey = 'id_models';
    protected $allowedFields = [
        'kategori_models', 
        'gambar_models', 
        'durasi', 
        'harga_models'
    ];
}