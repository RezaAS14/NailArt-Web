<?php namespace App\Models;

use CodeIgniter\Model;

class DetailCheckoutModel extends Model
{
    protected $table = 'detail_checkout';
    protected $primaryKey = 'id_detailco';
    protected $allowedFields = [
        'id_checkout',
        'id_produk', 
        'jumlah_checkout',
        'harga_checkout'
    ];
    
    /**
     * Get checkout details with product information
     */
    public function getDetailsByCheckoutId($checkoutId)
    {
        return $this->select('detail_checkout.*, accessories.nama_produk, accessories.gambar_produk')
                    ->join('accessories', 'accessories.id_produk = detail_checkout.id_produk')
                    ->where('detail_checkout.id_checkout', $checkoutId)
                    ->findAll();
    }
    
    /**
     * Count total items in a checkout
     */
    public function countItemsByCheckout($checkoutId)
    {
        return $this->where('id_checkout', $checkoutId)
                    ->selectSum('jumlah_checkout', 'total')
                    ->first()['total'] ?? 0;
    }
}
