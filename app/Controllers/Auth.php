<?php namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function __construct()
    {
        helper(['url', 'form', 'session']);
    }

    /**
     * Method untuk memproses login form.
     */
    public function do_login()
    {
        $session = session();
        $model = new UserModel();

        $identifier = $this->request->getPost('identifier'); // Bisa email atau username
        $password = $this->request->getPost('password');

        session()->setFlashdata('identifier', $identifier);
        
        // Asumsi Model sudah punya findUserByIdentifier()
        $user = $model->findUserByIdentifier($identifier);

        if ($user) {
            
            // ASUMSI: Password di DB adalah PLAIN TEXT ('admin123').
            // CATATAN PENTING: Untuk aplikasi nyata, GANTI dengan `password_verify($password, $user['password'])`
            $is_valid_password = ($user['password'] === $password); 
            
            if ($is_valid_password) {
                $ses_data = [
                    'id_user'   => $user['id_user'], // id_user diambil dari tabel user
                    'username'  => $user['username'], // username diambil dari tabel user
                    'email'     => $user['email'], // email diambil dari tabel user
                    'role'      => $user['role'], // role diambil dari tabel user
                    'logged_in' => TRUE
                ];
                
                $session->set($ses_data);
                
                // --- FLASH DATA UNTUK ALERT SUKSES LOGIN ---
                $session->setFlashdata('login_success_message', 'Login Berhasil!');
                $session->setFlashdata('username', $user['username']);
                // ------------------------------------

                // Cek role dan arahkan ke dashboard yang sesuai
                if ($user['role'] === 'admin') {
                    // Jika Admin, arahkan ke Dashboard Admin
                    return redirect()->to(site_url('admin/dashboard')); 
                }
                
                // Jika bukan admin (role 'user'), arahkan ke Halaman Profil
                // Sesuai rute: $routes->get('/profil', 'Home::profil');
                return redirect()->to(site_url('profil')); 
                
            } else {
                $session->setFlashdata('login_error', 'Password yang Anda masukkan salah.');
                return redirect()->back()->withInput(); 
            }
        } else {
            $session->setFlashdata('login_error', 'Email atau Username tidak terdaftar.');
            return redirect()->back()->withInput(); 
        }
    }

    /**
     * Method untuk memproses pendaftaran user baru.
     */
    public function do_register()
    {
        $session = session();
        $model = new UserModel();

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_depan' => 'required|min_length[2]|max_length[30]',
            'nama_belakang' => 'max_length[30]',
            'username' => 'required|min_length[3]|max_length[20]|is_unique[user.username]',
            'email' => 'required|valid_email|is_unique[user.email]',
            'tanggal_lahir' => 'required|valid_date',
            'nomor_handphone' => 'required|numeric|min_length[10]|max_length[13]',
            'alamat' => 'permit_empty|max_length[500]',
            'password' => 'required|min_length[8]'
        ], [
            'username' => [
                'is_unique' => 'Username sudah digunakan, pilih username lain.'
            ],
            'email' => [
                'is_unique' => 'Email sudah terdaftar, gunakan email lain.'
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $session->setFlashdata('register_error', implode(' ', $validation->getErrors()));
            return redirect()->back()->withInput();
        }

        // Ambil data dari form
        $data = [
            'nama_depan' => $this->request->getPost('nama_depan'),
            'nama_belakang' => $this->request->getPost('nama_belakang'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'no_telp' => $this->request->getPost('nomor_handphone'),
            'alamat' => $this->request->getPost('alamat'),
            'password' => $this->request->getPost('password'), // PLAIN TEXT (untuk development, sebaiknya gunakan password_hash di production)
            'role' => 'user'
        ];

        // Simpan ke database
        if ($model->insert($data)) {
            $session->setFlashdata('register_success', 'Akun berhasil dibuat! Silakan login.');
            return redirect()->to(site_url('daftar'));
        } else {
            $session->setFlashdata('register_error', 'Pendaftaran gagal, silakan coba lagi.');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Method untuk logout.
     */
    public function logout()
    {
        $session = session();
        
        $user_role = $session->get('role') ?? 'user'; 
        
        // --- Atur Flashdata untuk Alert Logout SEBELUM destroy ---
        $session->setFlashdata('is_logged_out', TRUE);
        $session->setFlashdata('logout_role', $user_role);
        
        // Hancurkan sesi (dilakukan setelah set flashdata)
        $session->destroy();
        
        return redirect()->to(site_url('/'));
    }
}