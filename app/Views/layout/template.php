<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Nail ART' ?></title>

    <link rel="icon" type="image/png" href="<?= base_url('assets/favicon/favicon-96x96.png') ?>" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="<?= base_url('assets/favicon/favicon.svg') ?>" />
    <link rel="shortcut icon" href="<?= base_url('assets/favicon/favicon.ico') ?>" />
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/favicon/apple-touch-icon.png') ?>" />
    <link rel="manifest" href="<?= base_url('assets/favicon/site.webmanifest') ?>" />

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Kapakana:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-dark': '#A3485A', // Warna utama (Navbar, Footer, Modal focus)
                        'nav-hover': '#A31111',    // Warna hover Navbar
                        'nav-inactive': '#D1A5AE', // Warna tombol Navbar yang tidak aktif
                        'menu-bg': '#A3485A',      // Warna latar belakang menu (Tidak terpakai)
                        'menu-hover': '#A3485A',   // Warna hover menu (Tidak terpakai)
                        'testing-bg': '#E6CFA9', // WARNA LATAR BELAKANG DESKRIPSI (Permintaan User)
                        // Tambahkan warna latar belakang yang digunakan di body atau section (jika perlu nama khusus)
                        'bg-light-yellow': '#FEF3E2', // Mengambil warna dari body (asumsi: FEF3E2)
                        'card-info': '#E6CFA9', // Mengambil warna dari testing-bg untuk info card (asumsi)
                    },
                    fontFamily: {
                        kapakana: ['Kapakana', 'cursive'], // Font untuk judul
                        inika: ['Inika', 'serif'],         // Font untuk teks biasa
                    }
                }
            },
            // Menambahkan plugin aspect-ratio langsung di config untuk penggunaan langsung
            plugins: [
                function ({ addUtilities }) {
                    const newUtilities = {
                        '.aspect-w-3': { '--tw-aspect-w': '3' }, /* Diubah */
                        '.aspect-h-4': { '--tw-aspect-h': '3' }, /* Diubah */
                        '.aspect-3-4': {
                            'aspect-ratio': '3 / 3', /* Diubah */
                        },
                    }
                    addUtilities(newUtilities, ['responsive'])
                }
            ]
        }
    </script>

    <style>
        /* Shadow untuk tombol navigasi */
        .custom-navbar-shadow {
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.5);
        }

        /* Efek noise/tekstur untuk shape */
        .noise-shape {
            position: relative;
            overflow: hidden; /* Penting agar after tidak keluar */
        }

        .noise-shape::after {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            opacity: 0.25; /* Tingkat kebisingan */
            pointer-events: none;
            background-image: radial-gradient(#FFFDFA 10%, transparent 10%);
            background-size: 5px 5px; /* Ukuran butiran */
        }
        
        /* Shadow untuk dropdown menu (User) */
        .menu-shadow {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.5), 0 2px 4px -2px rgba(0, 0, 0, 0.5);
        }

        /* Styling Galeri Item */
        .gallery-item {
            border: 2px solid #E0C8A9; 
            border-radius: 0.5rem; /* rounded-lg */
            overflow: hidden; 
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out; 
            cursor: pointer;
            display: flex; 
            flex-direction: column; 
            /* Menyesuaikan border-radius bawah dan atas agar seperti gambar */
            /* Gambar memiliki rounded-t-lg, deskripsi memiliki rounded-b-lg */
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
            border-bottom-left-radius: 0.5rem;
            border-bottom-right-radius: 0.5rem;
        }

        .gallery-item:hover {
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2); 
        }

        /* Kontainer gambar untuk rasio aspek 3:4 (lebih tinggi ke bawah) */
        .image-container {
            overflow: hidden;
            position: relative;
            padding-top: 100%; /* Membuat kotak persegi */
            flex-shrink: 0;
        }

        .image-container img {
            position: absolute; 
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover; 
            display: block; 
            transition: transform 0.3s ease-in-out; 
        }

        /* Animasi Hover: Gambar membesar */
        .gallery-item:hover .image-container img {
            transform: scale(1.1); /* Gambar membesar 10% */
        }

        /* Styling untuk teks deskripsi */
        .gallery-item > div:last-child { 
            flex-grow: 1; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
        }
        
        /* Garis Header untuk judul section */
        .header-line {
            border-top: 2px solid #D1A5AE; /* Warna nav-inactive atau abu-abu terang */
            width: 100%;
        }
        
        /* Styling Card Produk */
        .product-card {
            border-radius: 0.5rem; /* rounded-lg */
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06); /* Shadow ringan */
            position: relative; /* Untuk positioning badge dan tombol */
            overflow: hidden; /* Penting untuk efek gambar */
            cursor: pointer;
        }

        .product-card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); /* Bayangan yang lebih kuat saat hover */
        }

        /* Container Gambar (membuatnya persegi, mirip dengan gallery-item di CSS sebelumnya) */
        .product-image-container {
            position: relative;
            width: 100%;
            padding-top: 100%; /* Membuat kotak persegi (1:1 aspect ratio) */
            overflow: hidden;
            margin-bottom: 0.5rem; /* Jarak antara gambar dan teks */
            border-radius: 0.25rem; /* Rounded ringan */
            border: 1px solid #D1A5AE; /* Border ringan di sekitar gambar */
        }

        .product-image-container img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease-in-out;
            border-radius: 0.5rem; /* Tambahkan border-radius ke gambar agar sesuai gambar referensi */
        }

        /* Efek Zoom Gambar saat hover (seperti di galeri) */
        .product-card:hover .product-image-container img {
            transform: scale(1.05);
        }
        
        /* Discount Badge (Merah di kiri atas) */
        .discount-badge {
            position: absolute;
            top: 8px; /* Posisi lebih ke dalam */
            left: 8px; /* Posisi lebih ke dalam */
            background-color: #A31111; /* Warna merah gelap (nav-hover) */
            color: white;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            font-weight: bold;
            z-index: 10;
            border-radius: 0.25rem;
        }

        /* Add to Cart Button (Plus di kanan atas) */
        .add-to-cart-button {
            position: absolute;
            top: 8px;
            right: 8px;
            background-color: white;
            color: #A3485A; /* primary-dark */
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
            z-index: 10;
            transition: background-color 0.2s, transform 0.2s;
            border: 1px solid #A3485A;
        }

        .add-to-cart-button:hover {
            background-color: #D1A5AE; /* nav-inactive */
            transform: scale(1.1);
        }

        /* Overlay Detail Produk (Sembunyikan secara default) */
        .product-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* Warna Overlay diubah menjadi abu-abu gelap transparan (seperti di gambar) */
            background-color: rgba(0, 0, 0, 0.5); 
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            z-index: 5; /* Di bawah badge dan tombol keranjang */
            border-radius: 0.25rem;
        }

        .product-card:hover .product-overlay {
            opacity: 1; /* Tampilkan saat hover */
        }

        .detail-button {
            /* Latar belakang tombol Detail Produk menjadi putih */
            background-color: #D9D9D9; 
            color: #000000ff;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            font-family: 'Inika', serif;
            transition: background-color 0.2s;
            text-decoration: none;
            border: none;
        }

        .detail-button:hover {
            background-color: #BFBFBF; /* Warna hover tombol Detail Produk buat agak dark(testing-bg) */
        }
        /* --- Styling Khusus Halaman Detail Produk --- */

        /* Latar belakang kartu detail dengan warna testing-bg dan noise-shape */
        .detail-card {
            background-color: #E6CFA9; /* testing-bg */
            border-radius: 0.5rem; /* rounded-lg */
            padding: 1.5rem; 
            position: relative;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.06);
            /* Menambahkan noise-shape class styling */
            overflow: hidden; 
        }

        .detail-card::after {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            opacity: 0.25; /* Tingkat kebisingan (sama seperti noise-shape) */
            pointer-events: none;
            background-image: radial-gradient(#FFFDFA 10%, transparent 10%);
            background-size: 5px 5px; /* Ukuran butiran */
        }

        /* Badge Diskon di Detail (Merah di kiri atas) */
        .discount-badge-detail {
            position: absolute;
            top: 0;
            left: 0;
            background-color: #A31111; /* Warna merah gelap (nav-hover) */
            color: white;
            padding: 0.25rem 0.75rem;
            font-size: 0.875rem; /* text-sm */
            font-weight: bold;
            z-index: 10;
            border-top-left-radius: 0.5rem;
            border-bottom-right-radius: 0.5rem;
        }

        /* Tombol Kembali (Panah melengkung di kanan atas) */
        .back-button {
            position: absolute;
            top: 1.5rem; /* Menyesuaikan dengan padding */
            right: 1.5rem; /* Menyesuaikan dengan padding */
            color: black;
            font-size: 1.5rem;
            line-height: 1;
            z-index: 10;
            transition: transform 0.2s;
        }

        .back-button:hover {
            transform: scale(1.1);
            color: #A3485A; /* primary-dark */
        }

        /* Container Gambar Detail Produk */
        .product-detail-image-container {
            position: relative;
            /* Dibuat agar proporsional mirip gambar referensi */
            width: 400px; /* Lebar tetap untuk desktop */
            height: 400px; /* Tinggi tetap untuk desktop */
            overflow: hidden;
            border-radius: 0.5rem;
            border: 1px solid #D1A5AE; /* Border ringan */
        }

        .product-detail-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* Tombol Add to Cart (Plus di kanan bawah gambar) */
        .add-to-cart-button-detail {
            position: absolute;
            bottom: 8px; 
            right: 8px;
            background-color: white;
            color: #A3485A; /* primary-dark */
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
            z-index: 10;
            transition: background-color 0.2s, transform 0.2s;
            border: 1px solid #A3485A;
            font-size: 1rem;
        }

        .add-to-cart-button-detail:hover {
            background-color: #D1A5AE; /* nav-inactive */
            transform: scale(1.1);
        }

        /* Responsif untuk gambar (agar tidak terlalu besar di mobile) */
        @media (max-width: 767px) {
            .product-detail-image-container {
                width: 250px; /* Lebih kecil di mobile */
                height: 250px;
                margin: 0 auto; /* Tengah di mobile */
            }
            .detail-card {
                padding: 1rem;
            }
        }

        /* Styling untuk Cart Badge */
        .cart-badge {
            position: absolute;
            top: -5px; /* Sesuaikan posisi vertikal */
            right: -5px; /* Sesuaikan posisi horizontal */
            background-color: #A31111; /* Warna merah, sesuaikan jika perlu */
            color: white;
            border-radius: 50%;
            font-size: 0.65rem; /* Ukuran font lebih kecil */
            font-weight: bold;
            min-width: 18px; /* Lebar minimum */
            height: 18px; /* Tinggi */
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2px;
            line-height: 1;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body class="bg-[#FEF3E2] text-gray-800">

    <header class="w-full bg-primary-dark py-2 px-6">
        <div class="max-w-7xl mx-auto flex items-center justify-between">

            <div class="flex items-center ml-10">
                <img src="<?= base_url('assets/logo.jpg') ?>" alt="Logo Nail Art"
                    class="w-32 h-32 rounded-full shadow-lg object-cover" />
            </div>

            <nav class="flex space-x-4" id="main-nav-links">
                <a href="<?= site_url('/') ?>"
                    class="px-5 py-2 rounded-full text-white custom-navbar-shadow text-sm hover:bg-nav-hover transition duration-300 bg-nav-inactive"
                    data-path="/">
                    Beranda
                </a>
                <a href="<?= site_url('gallery') ?>" 
                    class="px-5 py-2 rounded-full text-white custom-navbar-shadow text-sm hover:bg-nav-hover transition duration-300 bg-nav-inactive"
                    data-path="gallery">
                    Gallery
                </a>
                <a href="<?= site_url('about') ?>" 
                    class="px-5 py-2 rounded-full text-white custom-navbar-shadow text-sm hover:bg-nav-hover transition duration-300 bg-nav-inactive"
                    data-path="about">
                    About Us
                </a>
                <a href="<?= site_url('models') ?>" 
                    class="px-5 py-2 rounded-full text-white custom-navbar-shadow text-sm hover:bg-nav-hover transition duration-300 bg-nav-inactive"
                    data-path="models">
                    Models
                </a>
                <a href="<?= site_url('accessories') ?>" 
                    class="px-5 py-2 rounded-full text-white custom-navbar-shadow text-sm hover:bg-nav-hover transition duration-300 bg-nav-inactive"
                    data-path="accessories">
                    Accessories
                </a>
            </nav>
            <div class="flex space-x-2">
                <a href="https://wa.me/6285760549969?text=Kak%20saya%20mau%20bertanya%F0%9F%99%8F" target="_blank" class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-primary-dark shadow hover:shadow-lg active:shadow-inner active:bg-gray-100 transition duration-200"><i class="fa-brands fa-whatsapp"></i></a>
                <a href="https://www.instagram.com/rena_ils04" target="_blank" class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-primary-dark shadow hover:shadow-lg active:shadow-inner active:bg-gray-100 transition duration-200"><i class="fa-brands fa-instagram"></i></a>
                
                <a href="<?php echo session()->has('logged_in') ? site_url('keranjang') : '#'; ?>" id="cart-link" 
                   class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-primary-dark shadow hover:shadow-lg active:shadow-inner active:bg-gray-100 transition duration-200 relative"
                   data-path="keranjang"
                   title="Keranjang Belanja"
                   <?php if (!session()->has('logged_in')): ?>onclick="event.preventDefault(); showLoginRequiredAlert();"<?php endif; ?>>
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span id="cart-count-badge" class="cart-badge hidden">0</span>
                </a>
                <div id="user-container" class="relative">
                    <a href="#" id="user-trigger" class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-primary-dark shadow hover:shadow-lg active:shadow-inner active:bg-gray-100 transition duration-200 <?= session()->has('logged_in') ? '' : 'hidden' ?>">
                        <i class="fa-solid fa-user"></i>
                    </a>

                    <div id="user-dropdown-menu" class="absolute right-0 mt-2 w-40 bg-white rounded-lg menu-shadow z-50 p-1 hidden border border-gray-200">
                        <button id="btn-profile" class="w-full text-center py-2 px-3 rounded-md bg-white text-primary-dark hover:bg-nav-hover hover:text-white transition duration-200 flex items-center text-sm font-semibold shadow-sm">
                            <i class="fa-solid fa-user mr-2"></i> PROFIL
                        </button>
                        
                        <button id="btn-logout" class="w-full text-center mt-1 py-2 px-3 rounded-md bg-white text-primary-dark hover:bg-nav-hover hover:text-white transition duration-200 flex items-center text-sm font-semibold shadow-sm">
                            <i class="fa-solid fa-right-from-bracket mr-2"></i> LOGOUT
                        </button>
                    </div>

                    <a href="#" id="btn-show-login-modal" class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-primary-dark shadow hover:shadow-lg active:shadow-inner active:bg-gray-100 transition duration-200 <?= session()->has('logged_in') ? 'hidden' : '' ?>" title="Login">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i>
                    </a>
                </div>

            </div>
        </div>
    </header>

    <?= $this->renderSection('beranda') ?>
    <?= $this->renderSection('galeri') ?>
    <?= $this->renderSection('about') ?>
    <?= $this->renderSection('models') ?>
    <?= $this->renderSection('accessories') ?>
    <?= $this->renderSection('detail_accessory') ?>
    <?= $this->renderSection('profil') ?>
    <?= $this->renderSection('keranjang') ?>


    <footer class="w-full bg-primary-dark py-6 px-10">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center md:items-start gap-10">

            <div class="flex-1">
                <h2 class="text-5xl font-kapakana text-black text-center mb-3">
                    Nail Artist
                </h2>

                <p class="text-white font-inika leading-relaxed text-justify">
                    Rezeki Nauli atau biasa dipanggil rena, adalah owner sekaligus nailart artis di rena_ils Studio.
                    Ia Mengembangkan Usaha ini berdasarkan hobinya sendiri dan saran dari pasangannya. 
                    Dia sangat suka berkomunikasi dan membahas design yang detail. 
                    Rena ga sabar untuk memulai melukis di kuku-kuku jarimu! 
                    Follow instagram <a href="https://www.instagram.com/rena_ils04" target="_blank" class="underline hover:text-nav-inactive">@rena_ils04</a> untuk melihat karya-karyanya dan 
                    untuk instagram pribadinya <a href="https://www.instagram.com/renn_rnlg" target="_blank" class="underline hover:text-nav-inactive">@renn_rnlg</a>.
                </p>
            </div>

            <div class="flex-shrink-0">
                <img src="<?= base_url('assets/img-footer.jpg') ?>" alt="Nail Artist Rena"
                    class="w-44 h-44 rounded-full object-cover shadow-lg">
            </div>

        </div>
    </footer>


    <div id="login-modal-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">

        <div id="login-modal" class="bg-[#F3EFE9] w-full max-w-md p-6 rounded-3xl shadow-2xl relative border-2 border-primary-dark" style="transform: scale(0.9); transition: transform 0.3s ease;">
            
            <h3 class="text-xl font-inika font-bold text-center mb-6 text-primary-dark">
                LOGIN RENA_ILS04
            </h3>

            <form id="login-form" action="<?= site_url('auth/do_login') ?>" method="POST" class="space-y-4">
                
                <div>
                    <label for="modal-email" class="block text-sm font-inika font-medium text-gray-700 mb-1">Email / Username</label>
                    <input type="text" id="modal-email" name="identifier" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-primary-dark focus:border-primary-dark sm:text-sm bg-white" 
                            placeholder="Masukkan Email atau Username" value="<?= old('identifier') ?>">
                </div>

                <div>
                    <label for="modal-password" class="block text-sm font-inika font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative mt-1">
                        <input type="password" id="modal-password" name="password" required
                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-primary-dark focus:border-primary-dark sm:text-sm pr-10 bg-white" 
                                placeholder="Masukkan password Anda">
                        
                        <button type="button" id="toggle-password" 
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-primary-dark transition duration-150">
                            <i class="fa-solid fa-eye-slash"></i> 
                        </button>
                    </div>
                </div>

                <?php if (session()->getFlashdata('login_error')): ?>
                    <div id="login-message-server" class="text-center text-red-600 text-sm font-semibold">
                        <?= session()->getFlashdata('login_error') ?>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', openModal);
                    </script>
                <?php endif; ?>

                <div id="login-message" class="text-center text-red-600 hidden text-sm font-semibold"></div>

                <button type="submit" 
                        class="w-full py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary-dark hover:bg-nav-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-dark transition duration-150">
                    LOGIN
                </button>
            </form>

            <div class="text-center mt-4">
                <p class="text-sm text-gray-600">
                    Belum Punya Akun? 
                    <a href="<?= site_url('daftar') ?>" class="text-blue-600 hover:text-blue-800 font-medium">Daftar disini!</a>
                </p>
            </div>

            <button id="close-login-modal" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 transition duration-150">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
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
    
    <?php if (session()->getFlashdata('login_error')): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Login Gagal!',
                    text: '<?= session()->getFlashdata('login_error') ?>',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#A3485A'
                });
            });
        </script>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('access_denied')): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Akses Ditolak!',
                    text: '<?= session()->getFlashdata('access_denied') ?>',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#A3485A'
                });
            });
        </script>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('is_logged_out')): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Logout Berhasil',
                    text: 'Anda telah keluar dari sistem.',
                    icon: 'info',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#A3485A',
                    timer: 3000,
                    timerProgressBar: true
                });
            });
        </script>
    <?php endif; ?>
    
    <script>
        // --- FUNGSI NAV ACTIVE (REVISI FINAL) ---
        
        /**
         * Menentukan tautan navigasi mana yang aktif dan memperbarui tampilannya.
         */
        function setActiveNavAndTitle() {
            const navLinksContainer = document.getElementById('main-nav-links');
            // Ambil semua tautan di main-nav-links
            const mainNavLinks = navLinksContainer ? navLinksContainer.querySelectorAll('a') : [];
            
            // Ambil tautan keranjang secara terpisah
            const cartLink = document.getElementById('cart-link');
            
            // Gabungkan semua tautan yang perlu dicek status aktifnya
            const allNavLinks = [...mainNavLinks];
            if (cartLink) {
                allNavLinks.push(cartLink);
            }
            
            const currentPath = window.location.pathname.replace(/^\/|\/$/g, ''); 
            
            allNavLinks.forEach(link => { 
                const linkPath = link.getAttribute('data-path') ? link.getAttribute('data-path').replace(/^\/|\/$/g, '') : '';
                
                const isHome = (currentPath === '' && linkPath === ''); 
                // Logic aktif: (Home) ATAU (Path saat ini dimulai dengan linkPath DAN linkPath bukan kosong)
                const isActive = isHome || (currentPath !== '' && currentPath.startsWith(linkPath) && linkPath !== '');
                
                // --- LOGIKA UTAMA NAVIGASI (Beranda, Gallery, About Us, Models, Accessories) ---
                if (link.parentElement && link.parentElement.id === 'main-nav-links') {
                    // Hapus kedua kelas warna agar hanya satu yang diterapkan
                    link.classList.remove('bg-nav-inactive', 'bg-nav-hover');

                    if (isActive) {
                        // Nav Aktif: Warna nav-hover (Merah Gelap)
                        link.classList.add('bg-nav-hover');
                        link.classList.add('font-medium'); 
                    } else {
                        // Nav Tidak Aktif: Warna nav-inactive (Pink Muda) - DEFAULT
                        link.classList.add('bg-nav-inactive');
                        link.classList.remove('font-medium');
                    }
                    link.classList.add('text-white'); 

                // --- LOGIKA TOMBOL KERANJANG ---
                } else if (link.id === 'cart-link') {
                    const cartIcon = link.querySelector('i');

                    if (isActive) {
                        // Keranjang Aktif: Background nav-hover (Merah Gelap)
                        link.classList.remove('bg-white', 'text-primary-dark', 'active:bg-gray-100');
                        link.classList.add('bg-nav-hover');
                        
                        // Pastikan ikon berwarna putih
                        if (cartIcon) {
                            cartIcon.classList.add('text-white');
                            cartIcon.classList.remove('text-primary-dark');
                        }
                    } else {
                        // Keranjang Tidak Aktif (Default): Background putih
                        link.classList.remove('bg-nav-hover');
                        link.classList.add('bg-white', 'text-primary-dark', 'active:bg-gray-100');
                        
                        // Pastikan ikon berwarna primary-dark
                        if (cartIcon) {
                            cartIcon.classList.add('text-primary-dark');
                            cartIcon.classList.remove('text-white');
                        }
                    }
                }
                
            });
        }


        // --- FUNGSI MODAL ---
        const modalOverlay = document.getElementById('login-modal-overlay');
        const modalBox = document.getElementById('login-modal');
        const loginMessageDiv = document.getElementById('login-message'); // Ambil elemen pesan umum

        /** Membuka modal dengan animasi scale. */
        function openModal() {
            modalOverlay.classList.remove('hidden');
            setTimeout(() => { modalBox.style.transform = 'scale(1)'; }, 10);
        }

        /** Menutup modal dengan animasi scale dan menyembunyikan pesan error/logout. */
        function closeModal() {
            modalBox.style.transform = 'scale(0.9)';
            setTimeout(() => { modalOverlay.classList.add('hidden'); }, 300);
            
            // Menonaktifkan pesan error lokal dan dari server/logout saat menutup
            loginMessageDiv.classList.add('hidden'); 
            loginMessageDiv.textContent = ''; // Kosongkan pesan
            loginMessageDiv.classList.remove('text-green-600'); 
            loginMessageDiv.classList.add('text-red-600'); 

            const serverMsg = document.getElementById('login-message-server');
            if (serverMsg) { serverMsg.classList.add('hidden'); }
        }
        
        // --- FUNGSI LOGIN / LOGOUT (Diatur oleh PHP Session) ---
        // Menentukan status login berdasarkan PHP Session
        const isLoggedIn = <?= session()->has('logged_in') ? 'true' : 'false' ?>;
        const userRole = '<?= session()->get('role') ?? 'guest' ?>';


        /** Handle logout. */
        function handleLogout() {
            // Arahkan ke Controller Auth::logout
            window.location.href = '<?= site_url("auth/logout") ?>'; 
        }
        
        /** Show login required alert for cart */
        function showLoginRequiredAlert() {
            Swal.fire({
                icon: 'warning',
                title: 'Login Diperlukan',
                html: '<p>Silakan login terlebih dahulu untuk mengakses keranjang belanja.</p>',
                confirmButtonColor: '#A3485A',
                showCancelButton: true,
                confirmButtonText: '<i class="fa-solid fa-right-to-bracket mr-2"></i>Login Sekarang',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    openModal();
                }
            });
        }

        // --- FUNGSI TOGGLE PASSWORD ---
        /** Mengubah tipe input password (show/hide). */
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('modal-password');
            const toggleButton = document.getElementById('toggle-password').querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleButton.classList.remove('fa-eye-slash');
                toggleButton.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                toggleButton.classList.remove('fa-eye');
                toggleButton.classList.add('fa-eye-slash');
            }
        }

        // --- FUNGSI KERANJANG BARU (Shared Global) ---
        const cartCountBadge = document.getElementById('cart-count-badge');
        const cartLink = document.getElementById('cart-link');

        /** Mengambil data keranjang dari localStorage. */
        function getCartData() {
            const data = localStorage.getItem('cartItems');
            if (!data || data === '[]') {
                return [];
            }
            return JSON.parse(data);
        }

        /** Menyimpan data keranjang ke localStorage. */
        function saveCartData(items) {
            localStorage.setItem('cartItems', JSON.stringify(items));
            updateCartBadge(); // Update badge setelah menyimpan
        }

        /** Memperbarui tampilan badge keranjang (dibuat global). */
        function updateCartBadge() {
            const isLoggedIn = <?= session()->has('logged_in') ? 'true' : 'false' ?>;
            
            if (isLoggedIn) {
                // Jika user login, ambil dari server
                fetch('<?= site_url('cart/get') ?>')
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const count = data.items.reduce((sum, item) => sum + parseInt(item.jumlah_keranjang), 0);
                            cartCountBadge.textContent = count;
                            if (count > 0) {
                                cartCountBadge.classList.remove('hidden');
                            } else {
                                cartCountBadge.classList.add('hidden');
                            }
                        }
                    })
                    .catch(error => console.error('Error updating cart badge:', error));
            } else {
                // Jika guest, ambil dari localStorage
                const items = JSON.parse(localStorage.getItem('cartItems') || '[]');
                const count = items.reduce((sum, item) => sum + item.qty, 0);
                cartCountBadge.textContent = count;
                if (count > 0) {
                    cartCountBadge.classList.remove('hidden');
                } else {
                    cartCountBadge.classList.add('hidden');
                }
            }
        }

        /** Menambah 1 kuantitas produk ke keranjang (dipanggil dari tombol plus di accessories). */
        function incrementCart(productId, productDetails) {
            const isLoggedIn = <?= session()->has('logged_in') ? 'true' : 'false' ?>;
            
            if (isLoggedIn) {
                // Jika user login, kirim ke server via AJAX
                const realProductId = productId.replace('product_', '');
                
                fetch('<?= site_url('cart/add') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: new URLSearchParams({
                        '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
                        'product_id': realProductId,
                        'quantity': 1
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true
                        });
                        updateCartBadge();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: data.message,
                            confirmButtonColor: '#A3485A'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat menambahkan produk',
                        confirmButtonColor: '#A3485A'
                    });
                });
            } else {
                // Jika guest, simpan di localStorage
                let items = getCartData();
                let existingItem = items.find(item => item.id === productId);

                if (existingItem && existingItem.qty > 0) {
                    existingItem.qty += 1;
                } else {
                    if (existingItem) {
                        existingItem.qty = 1;
                    } else {
                        items.push({ 
                            id: productId, 
                            name: productDetails.name, 
                            price: productDetails.price, 
                            image: productDetails.image, 
                            qty: 1 
                        });
                    }
                }
                
                items = items.filter(item => item.qty > 0);
                saveCartData(items);
                
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Produk ditambahkan ke keranjang',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                });
            }
        }

        // --- INICIALISASI TAMPILAN DAN EVENT LISTENERS ---
        document.addEventListener('DOMContentLoaded', function() {
            const userTrigger = document.getElementById('user-trigger');
            const dropdownMenu = document.getElementById('user-dropdown-menu');
            const loginForm = document.getElementById('login-form');
            const btnShowLoginModal = document.getElementById('btn-show-login-modal');
            const btnLogout = document.getElementById('btn-logout');
            const closeButton = document.getElementById('close-login-modal');
            const togglePasswordButton = document.getElementById('toggle-password');
            const btnProfile = document.getElementById('btn-profile');

            // Panggil fungsi untuk mengatur nav active
            setActiveNavAndTitle();
            // Panggil fungsi untuk memuat hitungan keranjang awal
            updateCartBadge(); 

            // Event Listener untuk tombol Add to Cart (di accessories.php)
            // Tidak ada lagi karena sekarang menggunakan onclick di accessoris.php

            if (isLoggedIn) {
                // Tampilan SETELAH LOGIN: Ikon user dan dropdown terlihat
                
                // Toggle dropdown menu
                userTrigger.addEventListener('click', function(e) {
                    e.preventDefault();
                    dropdownMenu.classList.toggle('hidden');
                });
                
                // Logout event
                if (btnLogout) {
                    btnLogout.addEventListener('click', handleLogout);
                }

                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (userTrigger && dropdownMenu && !userTrigger.contains(e.target) && !dropdownMenu.contains(e.target)) {
                        dropdownMenu.classList.add('hidden');
                    }
                });

                // Profile link: Semua diarahkan ke /profil
                if (btnProfile) {
                    btnProfile.addEventListener('click', function() {
                        window.location.href = '<?= site_url("profil") ?>';
                    });
                }


            } else {
                // Tampilan SEBELUM LOGIN: Tombol login terlihat
                
                // Show modal event
                btnShowLoginModal.addEventListener('click', function(e) {
                    e.preventDefault();
                    openModal();
                });
                
                // Form submit event tidak perlu lagi di-handle oleh JS, biarkan form POST ke controller
            }
            
            // Event Listener untuk Toggle Password
            if (togglePasswordButton) {
                togglePasswordButton.addEventListener('click', togglePasswordVisibility);
            }

            // Event listeners untuk menutup modal
            if (closeButton) {
                closeButton.addEventListener('click', closeModal);
            }
            if (modalOverlay) {
                // Tutup modal jika mengklik area overlay di luar kotak modal
                modalOverlay.addEventListener('click', function(e) {
                    if (e.target === modalOverlay) {
                        closeModal();
                    }
                });
            }
            // Tutup modal saat tombol Escape ditekan
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modalOverlay && !modalOverlay.classList.contains('hidden')) {
                    closeModal();
                }
            });
            
        });
    </script>
</body>
</html>