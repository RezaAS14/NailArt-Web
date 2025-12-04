<?php namespace App\Models;

use CodeIgniter\Model;

class KeranjangModel extends Model
{
    protected $table = 'keranjang';
    protected $primaryKey = 'id_keranjang';
    protected $allowedFields = [
        'id_user', 
        'id_produk', 
        'jumlah_keranjang'
    ];
    
    /**
     * Ambil keranjang user dengan detail produk
     */
    public function getCartWithProducts($userId)
    {
        return $this->select('keranjang.*, accessories.nama_produk, accessories.harga_produk, accessories.diskon, accessories.gambar_produk, accessories.stok_tersedia')
                    ->join('accessories', 'accessories.id_produk = keranjang.id_produk')
                    ->where('keranjang.id_user', $userId)
                    ->findAll();
    }
    
    /**
     * Tambah atau update item di keranjang
     */
    public function addOrUpdateCart($userId, $productId, $quantity = 1)
    {
        $existing = $this->where('id_user', $userId)
                         ->where('id_produk', $productId)
                         ->first();
        
        if ($existing) {
            // Update quantity
            $newQty = $existing['jumlah_keranjang'] + $quantity;
            return $this->update($existing['id_keranjang'], ['jumlah_keranjang' => $newQty]);
        } else {
            // Insert new
            return $this->insert([
                'id_user' => $userId,
                'id_produk' => $productId,
                'jumlah_keranjang' => $quantity
            ]);
        }
    }
    
    /**
     * Hapus semua item keranjang user
     */
    public function clearCart($userId)
    {
        return $this->where('id_user', $userId)->delete();
    }
}
