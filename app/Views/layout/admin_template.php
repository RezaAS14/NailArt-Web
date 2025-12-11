<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard Admin' ?></title>

    <link rel="icon" type="image/png" href="<?= base_url('assets/favicon/favicon-96x96.png') ?>" sizes="96x96" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Kapakana:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Konfigurasi Tailwind CSS (Sama dengan layout utama)
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-dark': '#A3485A', 
                        'nav-hover': '#A31111', 
                        'nav-inactive': '#D1A5AE', 
                        'testing-bg': '#E6CFA9', // WARNA LATAR BELAKANG DESKRIPSI
                        'bg-light-yellow': '#FEF3E2', 
                        'card-info': '#E6CFA9', 
                        // Tambahan untuk Admin Dashboard
                        'sidebar-bg': '#A3485A', 
                        'sidebar-hover': '#A31111',
                    },
                    fontFamily: {
                        kapakana: ['Kapakana', 'cursive'], 
                        inika: ['Inika', 'serif'], 
                    }
                }
            }
        }
    </script>
    <style>
        /* Gaya Kustom Admin */
        .admin-link.active {
            background-color: #A31111; /* nav-hover */
            font-weight: bold;
        }
        
        /* Sidebar Toggle */
        #sidebar {
            transition: transform 0.3s ease-in-out;
        }
        #sidebar.collapsed {
            transform: translateX(-100%);
        }
        #mainContent {
            transition: margin-left 0.3s ease-in-out, width 0.3s ease-in-out;
        }
        #mainContent.expanded {
            margin-left: 0;
            width: 100%;
        }
    </style>
</head>

<body class="bg-gray-100 font-inika flex h-screen">

    <!-- Tombol Toggle Sidebar -->
    <button id="toggleSidebar" class="fixed top-4 left-4 z-30 bg-primary-dark text-white p-3 rounded-lg shadow-lg hover:bg-sidebar-hover transition duration-200">
        <i class="fa-solid fa-bars text-xl"></i>
    </button>

    <aside id="sidebar" class="w-64 bg-sidebar-bg text-white shadow-lg flex flex-col fixed h-full z-20">
        <div class="p-6 border-b border-white border-opacity-30">
            <h1 class="text-4xl font-inika text-black text-center">
                ADMIN
            </h1>
            <p class="text-xs text-center text-gray-200">RENA_ILS04</p>
        </div>

        <nav class="flex-grow p-4 space-y-2">
            <a href="<?= site_url('admin/dashboard') ?>" 
                class="admin-link flex items-center p-3 rounded-lg transition duration-200 hover:bg-sidebar-hover <?= (isset($currentPage) && $currentPage == 'dashboard') || !isset($currentPage) ? 'active' : '' ?>">
                <i class="fa-solid fa-chart-line mr-3"></i> Dashboard
            </a>
            <a href="<?= site_url('admin/gallery') ?>" 
                class="admin-link flex items-center p-3 rounded-lg transition duration-200 hover:bg-sidebar-hover <?= (isset($currentPage) && $currentPage == 'gallery') ? 'active' : '' ?>">
                <i class="fa-solid fa-image mr-3"></i> Kelola Gallery
            </a>
            <a href="<?= site_url('admin/models') ?>" 
                class="admin-link flex items-center p-3 rounded-lg transition duration-200 hover:bg-sidebar-hover <?= (isset($currentPage) && $currentPage == 'models') ? 'active' : '' ?>">
                <i class="fa-solid fa-palette mr-3"></i> Kelola Models
            </a>
            <a href="<?= site_url('admin/accessories') ?>" 
                class="admin-link flex items-center p-3 rounded-lg transition duration-200 hover:bg-sidebar-hover <?= (isset($currentPage) && $currentPage == 'accessories') ? 'active' : '' ?>">
                <i class="fa-solid fa-tag mr-3"></i> Kelola Produk
            </a>
            
            <a href="<?= site_url('admin/checkout') ?>" 
                class="admin-link flex items-center p-3 rounded-lg transition duration-200 hover:bg-sidebar-hover <?= (isset($currentPage) && $currentPage == 'checkout') ? 'active' : '' ?>">
                <i class="fa-solid fa-money-check-dollar mr-3"></i> Kelola Pesanan
            </a>
            <hr class="border-t border-white border-opacity-30 my-4">
            <a href="<?= site_url('admin/users') ?>" 
                class="admin-link flex items-center p-3 rounded-lg transition duration-200 hover:bg-sidebar-hover <?= (isset($currentPage) && $currentPage == 'users') ? 'active' : '' ?>">
                <i class="fa-solid fa-users-cog mr-3"></i> Kelola Users
            </a>
            <a href="<?= site_url('auth/logout') ?>" 
                class="flex items-center p-3 rounded-lg transition duration-200 bg-red-600 hover:bg-red-700 mt-4 text-white">
                <i class="fa-solid fa-right-from-bracket mr-3"></i> Logout
            </a>
        </nav>
    </aside>

    <div id="mainContent" class="flex-grow ml-64 p-8 overflow-y-auto w-[calc(100%-16rem)]">
        <?= $this->renderSection('dashboard_admin') ?>
        <?= $this->renderSection('gallery_management') ?>
        <?= $this->renderSection('models_management') ?>
        <?= $this->renderSection('accessories_management') ?>
        <?= $this->renderSection('users_management') ?>
        <?= $this->renderSection('checkout_management') ?>
    </div>

    <script>
        // Toggle Sidebar
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        
        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        });
        
        // Alert Login Berhasil
        <?php if (session()->getFlashdata('login_success_message')): ?>
            Swal.fire({
                title: 'Selamat Datang!',
                html: '<p class="text-lg">Selamat datang <strong><?= session()->getFlashdata('username') ?></strong> di Dashboard Admin Nail Art</p>',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#A3485A',
                timer: 5000,
                timerProgressBar: true,
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        <?php endif; ?>
        
        // Alert Login Error atau Akses Ditolak
        <?php if (session()->getFlashdata('login_error')): ?>
            Swal.fire({
                title: 'Akses Ditolak!',
                text: '<?= session()->getFlashdata('login_error') ?>',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#A3485A'
            });
        <?php endif; ?>
    </script>

</body>
</html>