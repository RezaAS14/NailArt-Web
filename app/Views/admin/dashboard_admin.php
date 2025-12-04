<?= $this->extend('layout/admin_template') ?>
<?= $this->section('dashboard_admin') ?>

<header class="bg-white p-4 rounded-lg shadow-md mb-8 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-primary-dark">
        <i class="fa-solid fa-chart-line mr-2"></i> Dashboard
    </h2>
    <div class="flex items-center text-sm text-gray-600">
        Selamat datang, <span class="font-bold text-primary-dark ml-1"><?= $username ?? 'Admin' ?></span>
    </div>
</header>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
    
    <div class="bg-card-info p-5 rounded-lg shadow-xl flex items-center justify-between">
        <div>
            <p class="text-sm font-semibold text-gray-700">Total Accessories</p>
            <p class="text-3xl font-bold text-primary-dark mt-1"><?= $total_accessories ?? 0 ?></p> 
        </div>
        <i class="fa-solid fa-box text-5xl text-primary-dark opacity-50"></i>
    </div>

    <div class="bg-card-info p-5 rounded-lg shadow-xl flex items-center justify-between">
        <div>
            <p class="text-sm font-semibold text-gray-700">Total Models</p>
            <p class="text-3xl font-bold text-primary-dark mt-1"><?= $total_models ?? 0 ?></p> 
        </div>
        <i class="fa-solid fa-pencil-ruler text-5xl text-primary-dark opacity-50"></i>
    </div>

    <div class="bg-card-info p-5 rounded-lg shadow-xl flex items-center justify-between">
        <div>
            <p class="text-sm font-semibold text-gray-700">Galeri Foto</p>
            <p class="text-3xl font-bold text-primary-dark mt-1"><?= $total_gallery ?? 0 ?></p> 
        </div>
        <i class="fa-solid fa-camera text-5xl text-primary-dark opacity-50"></i>
    </div>

    <div class="bg-card-info p-5 rounded-lg shadow-xl flex items-center justify-between">
        <div>
            <p class="text-sm font-semibold text-gray-700">Total Pengguna</p>
            <p class="text-3xl font-bold text-primary-dark mt-1"><?= $total_users ?? 0 ?></p> 
        </div>
        <i class="fa-solid fa-users text-5xl text-primary-dark opacity-50"></i>
    </div>

    <div class="bg-card-info p-5 rounded-lg shadow-xl flex items-center justify-between">
        <div>
            <p class="text-sm font-semibold text-gray-700">Total Checkout</p>
            <p class="text-3xl font-bold text-primary-dark mt-1"><?= $total_checkout ?? 0 ?></p> 
        </div>
        <i class="fa-solid fa-shopping-cart text-5xl text-primary-dark opacity-50"></i>
    </div>
</div>

<div class="bg-white p-6 rounded-lg shadow-md">
    <h3 class="text-xl font-bold text-primary-dark mb-4 border-b pb-2">Aksi Cepat Admin</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        
        <a href="<?= site_url('admin/gallery') ?>" class="text-center p-4 bg-primary-dark text-white rounded-lg hover:bg-nav-hover transition duration-200 shadow-md">
            <i class="fa-solid fa-image fa-2x mb-2"></i>
            <p class="font-semibold">Kelola Galeri</p>
        </a>
        
        <a href="<?= site_url('admin/models') ?>" class="text-center p-4 bg-primary-dark text-white rounded-lg hover:bg-nav-hover transition duration-200 shadow-md">
            <i class="fa-solid fa-palette fa-2x mb-2"></i>
            <p class="font-semibold">Kelola Model</p>
        </a>

        <a href="<?= site_url('admin/accessories') ?>" class="text-center p-4 bg-primary-dark text-white rounded-lg hover:bg-nav-hover transition duration-200 shadow-md">
            <i class="fa-solid fa-tag fa-2x mb-2"></i>
            <p class="font-semibold">Kelola Aksesoris</p>
        </a>

        <a href="<?= site_url('admin/checkout') ?>" class="text-center p-4 bg-primary-dark text-white rounded-lg hover:bg-nav-hover transition duration-200 shadow-md">
            <i class="fa-solid fa-truck fa-2x mb-2"></i>
            <p class="font-semibold">Lihat Pesanan</p>
        </a>

    </div>
</div>

<?php if (session()->getFlashdata('login_success_message')): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Login Berhasil!',
                html: '<p class="text-lg">Selamat datang <strong><?= session()->getFlashdata('username') ?></strong></p>',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#A3485A',
                timer: 3000,
                timerProgressBar: true
            });
        });
    </script>
<?php endif; ?>

<?= $this->endSection() ?>