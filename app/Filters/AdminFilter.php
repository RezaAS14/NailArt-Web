<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    /**
     * Filter untuk memastikan hanya admin yang bisa mengakses halaman admin.
     * Jika user biasa mencoba akses halaman admin, redirect ke home.
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek apakah user sudah login
        if (!session()->get('logged_in')) {
            session()->setFlashdata('login_error', 'Anda harus login untuk mengakses halaman admin.');
            return redirect()->to(site_url('/'));
        }
        
        // Cek apakah role adalah admin
        if (session()->get('role') !== 'admin') {
            session()->setFlashdata('login_error', 'Akses Ditolak: Anda tidak memiliki izin Admin.');
            return redirect()->to(site_url('/'));
        }
        
        // Jika sudah login sebagai admin, izinkan akses
        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada proses setelah response
    }
}
