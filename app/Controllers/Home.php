<?php

namespace App\Controllers;

use App\Models\AccessoriesModel;
use App\Models\GalleryModel;
use App\Models\ModelsModel;
use App\Models\KeranjangModel;
use App\Models\CheckoutModel;
use App\Models\DetailCheckoutModel;
use App\Models\PesananModel;
use App\Models\UserModel;

class Home extends BaseController
{
    /**
     * Memuat URL Helper untuk memastikan fungsi base_url() dan site_url() tersedia di views.
     */
    public function __construct()
    {
        helper(['url', 'form']);
    }

    /**
     * Loads the 'about' view.
     */
    public function about(): string
    {
        return view('about', [
            'title' => 'Tentang Kami'
        ]);
    }

    /**
     * Loads the 'daftar' view (likely a registration or list page).
     */
    public function daftar(): string
    {
        return view('daftar');
    }
    public function profil(): string
    {
        // Cek apakah user sudah login
        if (!session()->get('logged_in')) {
            session()->setFlashdata('login_error', 'Silakan login terlebih dahulu');
            return redirect()->to(site_url('/'));
        }

        // Ambil data user dari database
        $userModel = new \App\Models\UserModel();
        $userId = session()->get('id_user');
        $userData = $userModel->find($userId);

        return view('profil', [
            'title' => 'Profil User',
            'userData' => $userData
        ]);
    }
    public function index()
    {
        return view('index', [
            'title' => 'Beranda Nail Art'
        ]);
    }
    
    public function gallery()
    {
        $galleryModel = new GalleryModel();
        
        return view('gallery', [
            'title' => 'Galeri Nail Art',
            'gallery_items' => $galleryModel->orderBy('id_gallery', 'ASC')->findAll()
        ]);
    }

    public function models()
    {
        $modelsModel = new ModelsModel();
        
        return view('models', [
            'title' => 'Model Nail Art',
            'models' => $modelsModel->orderBy('id_models', 'ASC')->findAll()
        ]);
    }
    
    public function accessories()
    {
        $accessoriesModel = new AccessoriesModel();
        
        return view('accessoris', [
            'title' => 'Aksesoris Nail Art',
            'accessories' => $accessoriesModel->orderBy('id_produk', 'ASC')->findAll()
        ]);
    }
    
    public function keranjang()
    {
        return view('keranjang', [
            'title' => 'Keranjang Belanja'
        ]);
    }
    
    /**
     * API: Tambah produk ke keranjang (AJAX)
     */
    public function addToCart()
    {
        if (!session()->get('logged_in')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu'
            ]);
        }
        
        $productId = $this->request->getPost('product_id');
        $quantity = $this->request->getPost('quantity') ?? 1;
        $userId = session()->get('id_user');
        
        $keranjangModel = new KeranjangModel();
        $accessoriesModel = new AccessoriesModel();
        
        // Check existing cart quantity
        $existingCart = $keranjangModel->where('id_user', $userId)
                                       ->where('id_produk', $productId)
                                       ->first();
        
        $currentCartQty = $existingCart ? $existingCart['jumlah_keranjang'] : 0;
        $newTotalQty = $currentCartQty + $quantity;
        
        // Validate stock availability
        if (!$accessoriesModel->checkStock($productId, $newTotalQty)) {
            $product = $accessoriesModel->find($productId);
            $availableStock = $product['stok_tersedia'] ?? 0;
            
            if ($availableStock == 0) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Stok habis untuk produk ini'
                ]);
            }
            
            return $this->response->setJSON([
                'success' => false,
                'message' => "Stok tidak mencukupi. Tersedia: {$availableStock}, di keranjang: {$currentCartQty}"
            ]);
        }
        
        if ($keranjangModel->addOrUpdateCart($userId, $productId, $quantity)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan ke keranjang'
            ]);
        }
        
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal menambahkan produk'
        ]);
    }
    
    /**
     * API: Ambil data keranjang (AJAX)
     */
    public function getCartData()
    {
        if (!session()->get('logged_in')) {
            return $this->response->setJSON([
                'success' => false,
                'items' => []
            ]);
        }
        
        $userId = session()->get('id_user');
        $keranjangModel = new KeranjangModel();
        
        $items = $keranjangModel->getCartWithProducts($userId);
        
        return $this->response->setJSON([
            'success' => true,
            'items' => $items
        ]);
    }
    
    /**
     * API: Update quantity item di keranjang (AJAX)
     */
    public function updateCart()
    {
        if (!session()->get('logged_in')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu'
            ]);
        }
        
        $productId = $this->request->getPost('product_id');
        $quantity = $this->request->getPost('quantity');
        $userId = session()->get('id_user');
        
        $keranjangModel = new KeranjangModel();
        $accessoriesModel = new AccessoriesModel();
        
        // Validate stock availability
        if (!$accessoriesModel->checkStock($productId, $quantity)) {
            $product = $accessoriesModel->find($productId);
            $availableStock = $product['stok_tersedia'] ?? 0;
            
            if ($availableStock == 0) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Stok habis untuk produk ini'
                ]);
            }
            
            return $this->response->setJSON([
                'success' => false,
                'message' => "Stok tidak mencukupi. Maksimal yang dapat dibeli: {$availableStock}"
            ]);
        }
        
        // Find existing cart item
        $existing = $keranjangModel->where('id_user', $userId)
                                   ->where('id_produk', $productId)
                                   ->first();
        
        if ($existing) {
            if ($keranjangModel->update($existing['id_keranjang'], ['jumlah_keranjang' => $quantity])) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Keranjang berhasil diperbarui'
                ]);
            }
        }
        
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal memperbarui keranjang'
        ]);
    }
    
    /**
     * API: Hapus item dari keranjang (AJAX)
     */
    public function removeCart()
    {
        if (!session()->get('logged_in')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu'
            ]);
        }
        
        $productId = $this->request->getPost('product_id');
        $userId = session()->get('id_user');
        
        $keranjangModel = new KeranjangModel();
        
        // Delete item
        if ($keranjangModel->where('id_user', $userId)
                          ->where('id_produk', $productId)
                          ->delete()) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Item berhasil dihapus dari keranjang'
            ]);
        }
        
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal menghapus item'
        ]);
    }
    
    /**
     * Update profil user
     */
    public function updateProfile()
    {
        // Cek apakah user sudah login
        if (!session()->get('logged_in')) {
            session()->setFlashdata('login_error', 'Silakan login terlebih dahulu');
            return redirect()->to(site_url('/'));
        }

        $userModel = new \App\Models\UserModel();
        $userId = session()->get('id_user');

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_depan' => 'required|min_length[2]|max_length[30]',
            'nama_belakang' => 'max_length[30]',
            'tanggal_lahir' => 'permit_empty|valid_date',
            'handphone' => 'permit_empty|numeric|min_length[10]|max_length[13]',
            'alamat' => 'permit_empty|max_length[500]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            session()->setFlashdata('profile_error', implode(' ', $validation->getErrors()));
            return redirect()->back()->withInput();
        }

        // Data yang akan diupdate
        $data = [
            'nama_depan' => $this->request->getPost('nama_depan'),
            'nama_belakang' => $this->request->getPost('nama_belakang'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'no_telp' => $this->request->getPost('handphone'),
            'alamat' => $this->request->getPost('alamat')
        ];

        // Handle foto upload jika ada
        $imageUpload = $this->request->getFile('imageUpload');
        if ($imageUpload && $imageUpload->isValid() && !$imageUpload->hasMoved()) {
            // Validasi file
            $validationImg = $validation->setRules([
                'imageUpload' => 'uploaded[imageUpload]|max_size[imageUpload,2048]|is_image[imageUpload]'
            ]);

            if (!$validationImg->withRequest($this->request)->run()) {
                session()->setFlashdata('profile_error', 'Foto profil harus berupa gambar (max 2MB)');
                return redirect()->back()->withInput();
            }

            // Hapus foto lama jika ada
            $oldData = $userModel->find($userId);
            if (!empty($oldData['gambar_user']) && file_exists(FCPATH . 'uploads/users/' . $oldData['gambar_user'])) {
                unlink(FCPATH . 'uploads/users/' . $oldData['gambar_user']);
            }

            // Upload foto baru
            $newName = $imageUpload->getRandomName();
            $imageUpload->move(FCPATH . 'uploads/users', $newName);
            $data['gambar_user'] = $newName;
        }

        // Update data ke database
        if ($userModel->update($userId, $data)) {
            // Update session jika ada perubahan nama
            session()->set('username', $data['nama_depan'] . ' ' . $data['nama_belakang']);
            
            session()->setFlashdata('profile_success', 'Profil berhasil diperbarui!');
            return redirect()->to(site_url('profil'));
        } else {
            session()->setFlashdata('profile_error', 'Gagal memperbarui profil, silakan coba lagi.');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Proses Checkout
     */
    public function processCheckout()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('login_error', 'Silakan login terlebih dahulu');
            return redirect()->to(site_url('/'));
        }
        
        $userId = session()->get('id_user');
        $totalHarga = $this->request->getPost('total_harga');
        $checkedItemsJson = $this->request->getPost('checked_items');
        $checkedItems = $checkedItemsJson ? json_decode($checkedItemsJson, true) : [];
        
        $checkoutModel = new CheckoutModel();
        $keranjangModel = new KeranjangModel();
        $detailCheckoutModel = new DetailCheckoutModel();
        $pesananModel = new PesananModel();
        $accessoriesModel = new AccessoriesModel();
        
        // Ambil data keranjang user
        $cartItems = $keranjangModel->getCartWithProducts($userId);
        
        if (empty($cartItems)) {
            session()->setFlashdata('checkout_error', 'Keranjang Anda kosong.');
            return redirect()->to(site_url('keranjang'));
        }
        
        // Filter hanya item yang dipilih (diceklis)
        $selectedItems = array_filter($cartItems, function($item) use ($checkedItems) {
            return in_array($item['id_produk'], $checkedItems);
        });
        
        if (empty($selectedItems)) {
            session()->setFlashdata('checkout_error', 'Tidak ada produk yang dipilih.');
            return redirect()->to(site_url('keranjang'));
        }
        
        // Validasi stok untuk semua item yang dipilih
        foreach ($selectedItems as $item) {
            if (!$accessoriesModel->checkStock($item['id_produk'], $item['jumlah_keranjang'])) {
                $product = $accessoriesModel->find($item['id_produk']);
                $availableStock = $product['stok_tersedia'] ?? 0;
                
                if ($availableStock == 0) {
                    session()->setFlashdata('checkout_error', "Stok habis untuk produk: {$item['nama_produk']}");
                } else {
                    session()->setFlashdata('checkout_error', "Stok tidak mencukupi untuk produk: {$item['nama_produk']}. Stok tersedia: {$availableStock}");
                }
                return redirect()->to(site_url('keranjang'));
            }
        }
        
        // Simpan checkout dengan tanggal
        $checkoutData = [
            'id_user' => $userId, 
            'total_harga' => $totalHarga,
            'tanggal_checkout' => date('Y-m-d H:i:s')
        ];
        
        if ($checkoutModel->insert($checkoutData)) {
            $checkoutId = $checkoutModel->getInsertID();
            
            // Simpan detail checkout hanya dari item yang dipilih dan kurangi stok
            foreach ($selectedItems as $item) {
                $detailData = [
                    'id_checkout' => $checkoutId,
                    'id_produk' => $item['id_produk'],
                    'jumlah_checkout' => $item['jumlah_keranjang'],
                    'harga_checkout' => $item['harga_produk'] * (1 - $item['diskon'] / 100) * $item['jumlah_keranjang']
                ];
                $detailCheckoutModel->insert($detailData);
                
                // Kurangi stok produk
                $accessoriesModel->reduceStock($item['id_produk'], $item['jumlah_keranjang']);
                
                // Hapus item dari keranjang
                $keranjangModel->where('id_user', $userId)
                               ->where('id_produk', $item['id_produk'])
                               ->delete();
            }

            // Buat record pesanan untuk tracking pembayaran & status
            $pesananModel->insert([
                'id_checkout' => $checkoutId,
                'keterangan_pembayaran' => 'Belum Bayar',
                'status_pesanan' => 'Menunggu Pembayaran'
            ]);
            
            // Ambil data user untuk ditampilkan di success message
            $userModel = new UserModel();
            $userData = $userModel->find($userId);
            $username = $userData['username'] ?? 'User';
            $alamat = $userData['alamat'] ?? 'Tidak tersedia';
            
            session()->setFlashdata('checkout_success', 'Checkout berhasil! Terima kasih atas pesanan Anda.');
            session()->setFlashdata('checkout_username', $username);
            session()->setFlashdata('checkout_alamat', $alamat);
            return redirect()->to(site_url('keranjang'));
        }
        
        session()->setFlashdata('checkout_error', 'Checkout gagal, silakan coba lagi.');
        return redirect()->to(site_url('keranjang'));
    }

    // --- Detail Views (Accessories) ---
    /**
     * Display accessory detail berdasarkan ID produk
     */
    public function detailAccessory($id)
    {
        $accessoriesModel = new AccessoriesModel();
        $product = $accessoriesModel->find($id);
        
        if (!$product) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        return view('detail_accessory', [
            'title' => 'Detail Produk',
            'product' => $product
        ]);
    }
}