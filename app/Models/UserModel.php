<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = [
        'gambar_user', 'username', 'nama_depan', 'nama_belakang', 
        'email', 'tanggal_lahir', 'no_telp', 'alamat', 'password', 'role'
    ];

    /**
     * Mencari user berdasarkan email atau username.
     * @param string $identifier Email atau Username
     * @return array|null 
     */
    public function findUserByIdentifier(string $identifier)
    {
        return $this->where('email', $identifier)
                    ->orWhere('username', $identifier)
                    ->first();
    }
}