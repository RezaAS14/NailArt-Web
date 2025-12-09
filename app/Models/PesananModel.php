<?php namespace App\Models;

use CodeIgniter\Model;

class PesananModel extends Model
{
    protected $table = 'pesanan';
    protected $primaryKey = 'id_pesanan';
    protected $allowedFields = ['id_checkout', 'keterangan_pembayaran', 'status_pesanan'];
    protected $useAutoIncrement = true;

    protected $attributes = [
        'keterangan_pembayaran' => 'Belum Bayar',
        'status_pesanan' => 'Menunggu Pembayaran',
    ];
}
