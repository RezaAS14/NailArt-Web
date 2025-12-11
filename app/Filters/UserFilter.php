<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class UserFilter implements FilterInterface
{
    /**
     * Filter untuk memblokir admin mengakses halaman user.
     * Admin harus logout dulu untuk bisa mengakses halaman user pengunjung.
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek apakah yang login adalah admin
        if (session()->get('logged_in') && session()->get('role') === 'admin') {
            session()->setFlashdata('access_denied', 'Anda sedang login sebagai Admin. Silakan logout terlebih dahulu untuk mengakses halaman ini.');
            return redirect()->to(site_url('admin/dashboard'));
        }
        
        // Jika bukan admin atau belum login, izinkan akses
        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada proses setelah response
    }
}
