<?php namespace App\Controllers;

use CodeIgniter\Controller;
// Import Models yang diperlukan
use App\Models\AccessoriesModel;
use App\Models\ModelsModel;
use App\Models\GalleryModel; // <-- Diperlukan
use App\Models\UserModel;
use App\Models\CheckoutModel; 
use App\Models\DetailCheckoutModel; 
use App\Models\PesananModel;

class Admin extends Controller
{
    /**
     * Konstruktor: memastikan hanya admin yang bisa mengakses.
     */
    public function __construct()
    {
        helper(['url', 'session']);

        if (!session()->get('logged_in')) {
            session()->setFlashdata('login_error', 'Anda harus login untuk mengakses halaman admin.');
            return redirect()->to(site_url('/'));
        }
        
        if (session()->get('role') !== 'admin') {
            session()->setFlashdata('login_error', 'Akses Ditolak: Anda tidak memiliki izin Admin.');
            return redirect()->to(site_url('/'));
        }
    }
    
    /**
     * Halaman Dashboard Admin
     * Menampilkan ringkasan data hitungan.
     */
    public function dashboard()
    {
        // Inisialisasi Models untuk menghitung data
        $accessoriesModel = new AccessoriesModel();
        $modelsModel = new ModelsModel();
        $galleryModel = new GalleryModel();
        $userModel = new UserModel();
        $checkoutModel = new CheckoutModel();
        
        // Ambil Total Data (Count) dari setiap tabel
        $data = [
            'title' => 'Dashboard Admin - Rena_ils04',
            'username' => session()->get('username'),
            'currentPage' => 'dashboard',
            
            // Data Dinamis untuk Card Dashboard
            'total_accessories' => $accessoriesModel->countAllResults(),
            'total_models'      => $modelsModel->countAllResults(),
            'total_gallery'     => $galleryModel->countAllResults(),
            // Hitung total user, mungkin tidak termasuk admin jika ada kolom 'role'
            'total_users'       => $userModel->where('role', 'user')->countAllResults(),
            'total_checkout'    => $checkoutModel->countAllResults(),
        ];
        
        return view('admin/dashboard_admin', $data);
    }
    
    /**
     * Halaman Kelola Gallery (READ Data)
     */
    public function gallery()
    {
        $galleryModel = new GalleryModel();
        
        $data = [
            'title' => 'Kelola Gallery - Admin',
            'currentPage' => 'gallery',
            // Ambil semua data galeri, diurutkan dari ID terkecil (data lama di atas, baru di bawah)
            'gallery_items' => $galleryModel->orderBy('id_gallery', 'ASC')->findAll()
        ];
        return view('admin/gallery_management', $data);
    }
    
    /**
     * Menyimpan (Create) atau Memperbarui (Update) data Galeri
     */
    public function saveGallery()
    {
        $galleryModel = new GalleryModel();
        
        // Ambil data POST
        $id_gallery = $this->request->getPost('id_gallery');
        $fileGambar = $this->request->getFile('gambar_gallery');
        $deskripsi = $this->request->getPost('deskripsi_gallery');
        
        $dataToSave = [
            'deskripsi_gallery' => $deskripsi,
        ];

        // 1. Logika Upload Gambar
        if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
            
            // Hapus gambar lama jika ini operasi Update
            if ($id_gallery) {
                $oldItem = $galleryModel->find($id_gallery);
                if ($oldItem && $oldItem['gambar_gallery'] && file_exists(ROOTPATH . 'public/uploads/gallery/' . $oldItem['gambar_gallery'])) {
                    // Coba hapus file lama
                    @unlink(ROOTPATH . 'public/uploads/gallery/' . $oldItem['gambar_gallery']);
                }
            }

            // Generate nama file unik dan pindahkan
            $newName = $fileGambar->getRandomName();
            // PENTING: Pastikan folder public/uploads/gallery sudah ada dan memiliki izin tulis
            $fileGambar->move(ROOTPATH . 'public/uploads/gallery', $newName);
            $dataToSave['gambar_gallery'] = $newName;
        } else if (!$id_gallery) {
            // Jika ini operasi Create dan tidak ada gambar diupload
            session()->setFlashdata('error', 'Gagal menyimpan: Gambar wajib diupload untuk foto baru.');
            return redirect()->back();
        }

        // 2. Simpan/Update data
        if ($id_gallery) {
            // Operasi Update
            $galleryModel->update($id_gallery, $dataToSave);
            session()->setFlashdata('success', 'Data Galeri berhasil diperbarui.');
        } else {
            // Operasi Create
            $galleryModel->insert($dataToSave);
            session()->setFlashdata('success', 'Foto Galeri baru berhasil ditambahkan.');
        }

        return redirect()->to(site_url('admin/gallery'));
    }

    /**
     * Menghapus data Galeri
     */
    public function deleteGallery($id)
    {
        $galleryModel = new GalleryModel();
        $item = $galleryModel->find($id);

        if ($item) {
            // Hapus file gambar dari server
            if ($item['gambar_gallery'] && file_exists(ROOTPATH . 'public/uploads/gallery/' . $item['gambar_gallery'])) {
                // Coba hapus file
                @unlink(ROOTPATH . 'public/uploads/gallery/' . $item['gambar_gallery']);
            }
            
            // Hapus data dari database
            $galleryModel->delete($id);
            session()->setFlashdata('success', 'Foto Galeri berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Foto Galeri tidak ditemukan.');
        }

        return redirect()->to(site_url('admin/gallery'));
    }
    
    /**
     * Halaman Kelola Models
     */
    public function models()
    {
        $modelsModel = new ModelsModel();
        
        $data = [
            'title' => 'Kelola Models - Admin',
            'currentPage' => 'models',
            'models' => $modelsModel->orderBy('id_models', 'ASC')->findAll()
        ];
        return view('admin/models_management', $data);
    }
    
    /**
     * Form Tambah Model
     */
    public function addModel()
    {
        $data = [
            'title' => 'Tambah Model - Admin',
            'currentPage' => 'models',
            'action' => 'add'
        ];
        return view('admin/form_models', $data);
    }
    
    /**
     * Form Edit Model
     */
    public function editModel($id)
    {
        $modelsModel = new ModelsModel();
        $model = $modelsModel->find($id);
        
        if (!$model) {
            session()->setFlashdata('error', 'Model tidak ditemukan.');
            return redirect()->to(site_url('admin/models'));
        }
        
        $data = [
            'title' => 'Edit Model - Admin',
            'currentPage' => 'models',
            'action' => 'edit',
            'model' => $model
        ];
        return view('admin/form_models', $data);
    }
    
    /**
     * Simpan atau Update Model
     */
    public function saveModel()
    {
        $modelsModel = new ModelsModel();
        
        $id = $this->request->getPost('id_models');
        $fileGambar = $this->request->getFile('gambar_models');
        
        $dataToSave = [
            'kategori_models' => $this->request->getPost('kategori_models'),
            'durasi' => $this->request->getPost('durasi'),
            'harga_models' => $this->request->getPost('harga_models')
        ];
        
        // Handle Upload Gambar
        if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
            // Hapus gambar lama jika update
            if ($id) {
                $oldModel = $modelsModel->find($id);
                if ($oldModel && $oldModel['gambar_models'] && file_exists(ROOTPATH . 'public/uploads/models/' . $oldModel['gambar_models'])) {
                    @unlink(ROOTPATH . 'public/uploads/models/' . $oldModel['gambar_models']);
                }
            }
            
            $newName = $fileGambar->getRandomName();
            $fileGambar->move(ROOTPATH . 'public/uploads/models', $newName);
            $dataToSave['gambar_models'] = $newName;
        } else if (!$id) {
            session()->setFlashdata('error', 'Gagal menyimpan: Gambar wajib diupload.');
            return redirect()->back()->withInput();
        }
        
        if ($id) {
            $modelsModel->update($id, $dataToSave);
            session()->setFlashdata('success', 'Model berhasil diperbarui.');
        } else {
            $modelsModel->insert($dataToSave);
            session()->setFlashdata('success', 'Model baru berhasil ditambahkan.');
        }
        
        return redirect()->to(site_url('admin/models'));
    }
    
    /**
     * Hapus Model
     */
    public function deleteModel($id)
    {
        $modelsModel = new ModelsModel();
        $model = $modelsModel->find($id);
        
        if ($model) {
            if ($model['gambar_models'] && file_exists(ROOTPATH . 'public/uploads/models/' . $model['gambar_models'])) {
                @unlink(ROOTPATH . 'public/uploads/models/' . $model['gambar_models']);
            }
            
            $modelsModel->delete($id);
            session()->setFlashdata('success', 'Model berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Model tidak ditemukan.');
        }
        
        return redirect()->to(site_url('admin/models'));
    }

    /**
     * Halaman Kelola Accessories
     */
    public function accessories()
    {
        $accessoriesModel = new AccessoriesModel();
        
        $data = [
            'title' => 'Kelola Accessories - Admin',
            'currentPage' => 'accessories',
            'accessories' => $accessoriesModel->orderBy('id_produk', 'ASC')->findAll()
        ];
        return view('admin/accessories_management', $data);
    }
    
    /**
     * Form Tambah Accessories
     */
    public function addAccessory()
    {
        $data = [
            'title' => 'Tambah Accessory - Admin',
            'currentPage' => 'accessories',
            'action' => 'add'
        ];
        return view('admin/form_accessories', $data);
    }
    
    /**
     * Form Edit Accessories
     */
    public function editAccessory($id)
    {
        $accessoriesModel = new AccessoriesModel();
        $accessory = $accessoriesModel->find($id);
        
        if (!$accessory) {
            session()->setFlashdata('error', 'Produk tidak ditemukan.');
            return redirect()->to(site_url('admin/accessories'));
        }
        
        $data = [
            'title' => 'Edit Accessory - Admin',
            'currentPage' => 'accessories',
            'action' => 'edit',
            'accessory' => $accessory
        ];
        return view('admin/form_accessories', $data);
    }
    
    /**
     * Simpan atau Update Accessories
     */
    public function saveAccessory()
    {
        $accessoriesModel = new AccessoriesModel();
        
        $id = $this->request->getPost('id_produk');
        $fileGambar = $this->request->getFile('gambar_produk');
        
        $dataToSave = [
            'nama_produk' => $this->request->getPost('nama_produk'),
            'harga_produk' => $this->request->getPost('harga_produk'),
            'diskon' => $this->request->getPost('diskon') ?? 0,
            'deskripsi_produk' => $this->request->getPost('deskripsi_produk'),
            'stok_tersedia' => $this->request->getPost('stok_tersedia')
        ];
        
        // Handle Upload Gambar
        if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
            // Hapus gambar lama jika update
            if ($id) {
                $oldProduct = $accessoriesModel->find($id);
                if ($oldProduct && $oldProduct['gambar_produk'] && file_exists(ROOTPATH . 'public/uploads/accessories/' . $oldProduct['gambar_produk'])) {
                    @unlink(ROOTPATH . 'public/uploads/accessories/' . $oldProduct['gambar_produk']);
                }
            }
            
            $newName = $fileGambar->getRandomName();
            $fileGambar->move(ROOTPATH . 'public/uploads/accessories', $newName);
            $dataToSave['gambar_produk'] = $newName;
        } else if (!$id) {
            session()->setFlashdata('error', 'Gagal menyimpan: Gambar wajib diupload.');
            return redirect()->back()->withInput();
        }
        
        if ($id) {
            $accessoriesModel->update($id, $dataToSave);
            session()->setFlashdata('success', 'Produk berhasil diperbarui.');
        } else {
            $accessoriesModel->insert($dataToSave);
            session()->setFlashdata('success', 'Produk baru berhasil ditambahkan.');
        }
        
        return redirect()->to(site_url('admin/accessories'));
    }
    
    /**
     * Hapus Accessories
     */
    public function deleteAccessory($id)
    {
        $accessoriesModel = new AccessoriesModel();
        $product = $accessoriesModel->find($id);
        
        if ($product) {
            if ($product['gambar_produk'] && file_exists(ROOTPATH . 'public/uploads/accessories/' . $product['gambar_produk'])) {
                @unlink(ROOTPATH . 'public/uploads/accessories/' . $product['gambar_produk']);
            }
            
            $accessoriesModel->delete($id);
            session()->setFlashdata('success', 'Produk berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Produk tidak ditemukan.');
        }
        
        return redirect()->to(site_url('admin/accessories'));
    }
    
    /**
     * Halaman Kelola Users
     */
    public function users()
    {
        $userModel = new UserModel();
        
        $data = [
            'title' => 'Kelola Users - Admin',
            'currentPage' => 'users',
            'users' => $userModel->orderBy('id_user', 'ASC')->findAll()
        ];
        return view('admin/users_management', $data);
    }
    
    /**
     * Hapus User
     */
    public function deleteUser($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);
        
        if ($user) {
            if ($user['role'] === 'admin') {
                session()->setFlashdata('error', 'Tidak dapat menghapus user dengan role Admin.');
                return redirect()->to(site_url('admin/users'));
            }
            
            if ($user['gambar_user'] && file_exists(ROOTPATH . 'public/uploads/users/' . $user['gambar_user'])) {
                @unlink(ROOTPATH . 'public/uploads/users/' . $user['gambar_user']);
            }
            
            $userModel->delete($id);
            session()->setFlashdata('success', 'User berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'User tidak ditemukan.');
        }
        
        return redirect()->to(site_url('admin/users'));
    }

    /**
     * Halaman Kelola Pesanan (Checkout)
     * Mengambil data dari tabel checkout dan user.
     */
    public function checkout()
    {
        // Inisialisasi Model Checkout dan Detail Checkout
        $checkoutModel = new CheckoutModel();
        $detailCheckoutModel = new DetailCheckoutModel();
        $pesananModel = new PesananModel();
        
        // Ambil data checkout + user + pesanan (LEFT JOIN agar tetap tampil meski belum ada pesanan)
        $checkouts = $checkoutModel
                ->select('checkout.*, user.username, user.nama_depan, user.nama_belakang, user.email, user.alamat, pesanan.id_pesanan, pesanan.keterangan_pembayaran, pesanan.status_pesanan')
                ->join('user', 'user.id_user = checkout.id_user')
                ->join('pesanan', 'pesanan.id_checkout = checkout.id_checkout', 'left')
                ->orderBy('checkout.id_checkout', 'ASC') // Urutkan dari yang terlama (data baru di bawah)
                ->findAll();
        
        // Tambahkan total items untuk setiap checkout
        foreach ($checkouts as &$checkout) {
            $checkout['total_items'] = $detailCheckoutModel->countItemsByCheckout($checkout['id_checkout']);
        }

        $data = [
            'title' => 'Kelola Pesanan (Checkout) - Admin',
            'currentPage' => 'checkout',
            'checkout_data' => $checkouts // Data pesanan yang akan ditampilkan di view
        ];
        
        return view('admin/checkout_management', $data);
    }
    
    /**
     * Get checkout detail (AJAX)
     */
    public function checkoutDetail($id)
    {
        $checkoutModel = new CheckoutModel();
        $detailCheckoutModel = new DetailCheckoutModel();
        
        // Get checkout info
        $checkout = $checkoutModel
            ->select('checkout.*, user.nama_depan, user.nama_belakang, user.email, user.alamat')
            ->join('user', 'user.id_user = checkout.id_user')
            ->find($id);
        
        if (!$checkout) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan'
            ]);
        }
        
        // Get checkout items
        $items = $detailCheckoutModel->getDetailsByCheckoutId($id);
        
        return $this->response->setJSON([
            'success' => true,
            'checkout' => $checkout,
            'items' => $items
        ]);
    }
    
    /**
     * Hapus Checkout
     */
    public function deleteCheckout($id)
    {
        $checkoutModel = new CheckoutModel();
        $detailCheckoutModel = new DetailCheckoutModel();
        $pesananModel = new PesananModel();
        $checkout = $checkoutModel->find($id);
        
        if ($checkout) {
            // Delete detail checkout first (foreign key constraint)
            $detailCheckoutModel->where('id_checkout', $id)->delete();
            // Delete pesanan jika ada
            $pesananModel->where('id_checkout', $id)->delete();
            // Then delete checkout
            $checkoutModel->delete($id);
            session()->setFlashdata('success', 'Transaksi checkout berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Transaksi checkout tidak ditemukan.');
        }
        
        return redirect()->to(site_url('admin/checkout'));
    }

    /**
     * Update status pesanan & pembayaran (persist ke DB)
     */
    public function updatePesananStatus()
    {
        $pesananModel = new PesananModel();

        $idCheckout = $this->request->getPost('id_checkout');
        $keterangan = $this->request->getPost('keterangan');
        $status = $this->request->getPost('status');

        if (!$idCheckout) {
            return $this->response->setJSON(['success' => false, 'message' => 'ID checkout tidak ditemukan']);
        }

        // Pastikan record ada, kalau belum ada buat dulu
        $existing = $pesananModel->where('id_checkout', $idCheckout)->first();

        $payload = [
            'keterangan_pembayaran' => $keterangan ?? 'Belum Bayar',
            'status_pesanan' => $status ?? 'Menunggu Pembayaran'
        ];

        if ($existing) {
            $pesananModel->update($existing['id_pesanan'], $payload);
        } else {
            $payload['id_checkout'] = $idCheckout;
            $pesananModel->insert($payload);
        }

        return $this->response->setJSON(['success' => true, 'message' => 'Status pesanan diperbarui']);
    }
}
