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

    /**
     * Reduce stock for a product
     */
    public function reduceStock($productId, $quantity)
    {
        $product = $this->find($productId);
        
        if (!$product) {
            return false;
        }
        
        $newStock = $product['stok_tersedia'] - $quantity;
        
        if ($newStock < 0) {
            return false;
        }
        
        return $this->update($productId, ['stok_tersedia' => $newStock]);
    }

    /**
     * Check if stock is available
     */
    public function checkStock($productId, $requestedQty)
    {
        $product = $this->find($productId);
        
        if (!$product) {
            return false;
        }
        
        return $product['stok_tersedia'] >= $requestedQty;
    }
}