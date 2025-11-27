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

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-dark': '#A3485A', // Warna utama (Navbar, Footer, Modal focus)
                        'nav-hover': '#A31111',    // Warna hover Navbar
                        'nav-inactive': '#D1A5AE', // Warna tombol Navbar yang tidak aktif
                        'menu-bg': '#A3485A',      // Warna latar belakang menu (Tidak terpakai)
                        'menu-hover': '#A3485A',   // Warna hover menu (Tidak terpakai)
                        'testing-bg': '#E6CFA9', // WARNA LATAR BELAKANG DESKRIPSI (Permintaan User)
                        // Tambahkan warna latar belakang yang digunakan di body atau section (jika perlu nama khusus)
                        'bg-light-yellow': '#FEF3E2', // Mengambil warna dari body (asumsi: FEF3E2)
                        'card-info': '#E6CFA9', // Mengambil warna dari testing-bg untuk info card (asumsi)
                    },
                    fontFamily: {
                        kapakana: ['Kapakana', 'cursive'], // Font untuk judul
                        inika: ['Inika', 'serif'],        // Font untuk teks biasa
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
            width: 200px; /* Lebar tetap untuk desktop */
            height: 200px; /* Tinggi tetap untuk desktop */
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
                width: 150px; /* Lebih kecil di mobile */
                height: 150px;
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
                    class="px-5 py-2 rounded-full text-white custom-navbar-shadow text-sm hover:bg-nav-hover transition duration-300"
                    data-path="/">
                    Beranda
                </a>
                <a href="<?= site_url('gallery') ?>" 
                    class="px-5 py-2 rounded-full text-white custom-navbar-shadow text-sm hover:bg-nav-hover transition duration-300"
                    data-path="gallery">
                    Gallery
                </a>
                <a href="<?= site_url('about') ?>" 
                    class="px-5 py-2 rounded-full text-white custom-navbar-shadow text-sm hover:bg-nav-hover transition duration-300"
                    data-path="about">
                    About Us
                </a>
                <a href="<?= site_url('models') ?>" 
                    class="px-5 py-2 rounded-full text-white custom-navbar-shadow text-sm hover:bg-nav-hover transition duration-300"
                    data-path="models">
                    Models
                </a>
                <a href="<?= site_url('accessories') ?>" 
                    class="px-5 py-2 rounded-full text-white custom-navbar-shadow text-sm hover:bg-nav-hover transition duration-300"
                    data-path="accessories">
                    Accessories
                </a>
            </nav>
            <div class="flex space-x-2">
                <a href="https://wa.me/6285760549969?text=Kak%20saya%20mau%20bertanya%F0%9F%99%8F" target="_blank" class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-primary-dark shadow hover:shadow-lg active:shadow-inner active:bg-gray-100 transition duration-200"><i class="fa-brands fa-whatsapp"></i></a>
                <a href="https://www.instagram.com/rena_ils04" target="_blank" class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-primary-dark shadow hover:shadow-lg active:shadow-inner active:bg-gray-100 transition duration-200"><i class="fa-brands fa-instagram"></i></a>
                
                <a href="<?= site_url('keranjang') ?>" id="cart-link" class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-primary-dark shadow hover:shadow-lg active:shadow-inner active:bg-gray-100 transition duration-200 relative">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span id="cart-count-badge" class="cart-badge hidden">0</span>
                </a>
                <div id="user-container" class="relative">
                    <a href="#" id="user-trigger" class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-primary-dark shadow hover:shadow-lg active:shadow-inner active:bg-gray-100 transition duration-200">
                        <i class="fa-solid fa-user"></i>
                    </a>

                    <div id="user-dropdown-menu" class="absolute right-0 mt-2 w-36 bg-white rounded-lg menu-shadow z-50 p-1 hidden border border-gray-200">
                        <button id="btn-profile" class="w-full text-center py-2 px-3 rounded-md bg-white text-primary-dark hover:bg-nav-hover hover:text-white transition duration-200 flex items-center text-sm font-semibold shadow-sm">
                            <i class="fa-solid fa-user mr-2"></i> PROFILE
                        </button>
                        
                        <button id="btn-logout" class="w-full text-center mt-1 py-2 px-3 rounded-md bg-white text-primary-dark hover:bg-nav-hover hover:text-white transition duration-200 flex items-center text-sm font-semibold shadow-sm">
                            <i class="fa-solid fa-right-from-bracket mr-2"></i> LOGOUT
                        </button>
                    </div>

                    <a href="#" id="btn-show-login-modal" class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-primary-dark shadow hover:shadow-lg active:shadow-inner active:bg-gray-100 transition duration-200 hidden" title="Login">
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
    <?= $this->renderSection('detail_base_coat') ?>
    <?= $this->renderSection('detail_cuticle_nipper') ?>
    <?= $this->renderSection('detail_cuticle_pusher') ?>
    <?= $this->renderSection('detail_glitter') ?>
    <?= $this->renderSection('detail_nail_brush') ?>
    <?= $this->renderSection('detail_nail_file') ?>
    <?= $this->renderSection('detail_nail_polisher') ?>
    <?= $this->renderSection('detail_top_coat') ?>
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
                RENA_ILS04
            </h3>

            <form id="login-form" class="space-y-4">
                
                <div>
                    <label for="modal-email" class="block text-sm font-inika font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="modal-email" name="email" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-primary-dark focus:border-primary-dark sm:text-sm bg-white" 
                            placeholder="Masukkan email Anda">
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

    <script>
        // --- FUNGSI NAV ACTIVE (PENGATURAN TITLE DIHAPUS) ---
        
        /**
         * Menentukan tautan navigasi mana yang aktif dan memperbarui tampilannya.
         */
        function setActiveNavAndTitle() {
            const navLinksContainer = document.getElementById('main-nav-links');
            if (!navLinksContainer) return; 
            
            const navLinks = navLinksContainer.querySelectorAll('a');
            const currentPath = window.location.pathname.replace(/^\/|\/$/g, ''); 
            
            navLinks.forEach(link => {
                const linkPath = link.getAttribute('data-path').replace(/^\/|\/$/g, '');
                
                const isHome = (currentPath === '' && linkPath === ''); 

                // Logika untuk mencocokkan tautan aktif
                const isActive = isHome || (currentPath !== '' && currentPath.startsWith(linkPath) && linkPath !== '');
                
                // Atur class
                if (isActive) {
                    link.classList.remove('bg-nav-inactive');
                    link.classList.add('bg-nav-hover');
                    link.classList.add('font-medium'); 
                    link.classList.add('text-white');
                } else {
                    link.classList.remove('bg-nav-hover', 'font-medium');
                    link.classList.add('bg-nav-inactive');
                    link.classList.add('text-white');
                }
            });
        }

        // --- FUNGSI MODAL ---
        const modalOverlay = document.getElementById('login-modal-overlay');
        const modalBox = document.getElementById('login-modal');

        /** Membuka modal dengan animasi scale. */
        function openModal() {
            modalOverlay.classList.remove('hidden');
            setTimeout(() => { modalBox.style.transform = 'scale(1)'; }, 10);
        }

        /** Menutup modal dengan animasi scale dan menyembunyikan pesan error. */
        function closeModal() {
            modalBox.style.transform = 'scale(0.9)';
            setTimeout(() => { modalOverlay.classList.add('hidden'); }, 300);
            document.getElementById('login-message').classList.add('hidden'); 
        }
        
        // --- FUNGSI LOGIN / LOGOUT ---
        const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';

        /** Handle submit form login (Dummy Logic). */
        function handleLogin(e) {
            e.preventDefault();
            const email = document.getElementById('modal-email').value;
            const password = document.getElementById('modal-password').value;
            const messageElement = document.getElementById('login-message');

            // --- DUMMY LOGIN LOGIC ---
            // Kredensial: tes@gmail.com / 123
            if (email === 'tes@gmail.com' && password === '123') {
                localStorage.setItem('isLoggedIn', 'true');
                alert('Login Berhasil!');
                closeModal();
                window.location.reload(); 
            } else {
                messageElement.textContent = 'Email atau Password salah. (Coba: tes@gmail.com / 123)';
                messageElement.classList.remove('hidden');
            }
        }

        /** Handle logout. */
        function handleLogout() {
            localStorage.removeItem('isLoggedIn');
            alert('Anda telah Logout!');
            window.location.reload(); 
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

        // Data dummy produk (Harus sama dengan data di keranjang.php)
        const dummyProducts = [
            { id: 'nail_file', name: 'NAIL FILE', price: 10900, qty: 0, image: 'assets/nail-file.png' },
            { id: 'cuticle_nipper', name: 'CUTICLE NIPPER', price: 92000, qty: 0, image: 'assets/cuticle-nipper.png' },
            { id: 'cuticle_pusher', name: 'CUTICLE PUSHER', price: 3000, qty: 0, image: 'assets/cuticle-pusher.png' },
            { id: 'nail_brush', name: 'NAIL BRUSH', price: 29000, qty: 0, image: 'assets/nail-brush.png' },
            { id: 'base_coat', name: 'BASE COAT', price: 39480, qty: 0, image: 'assets/base-coat.png' },
            { id: 'top_coat', name: 'TOP COAT', price: 29046, qty: 0, image: 'assets/top-coat.png' },
            { id: 'nail_polisher', name: 'NAIL POLISHER', price: 43120, qty: 0, image: 'assets/nail-polisher.png' },
            { id: 'glitters', name: 'GLITTER', price: 85600, qty: 0, image: 'assets/glitters.png' },
        ];

        /** Mengambil data keranjang dari localStorage. */
        function getCartData() {
            const data = localStorage.getItem('cartItems');
            // Jika tidak ada data, kembalikan array kosong (atau array dengan 1 item default jika ini adalah load pertama)
            if (!data || data === '[]' || JSON.parse(data).length === 0) {
                 // Simulasi: Masukkan 1 item Cuticle Pusher, 0 Nail File, 0 Cuticle Nipper jika keranjang kosong
                 if (window.location.pathname.includes('keranjang')) {
                    const initialItems = [
                         { id: 'nail_file', name: 'NAIL FILE', price: 10900, qty: 0, image: '<?= base_url('assets/nail-file.png') ?>' },
                         { id: 'cuticle_nipper', name: 'CUTICLE NIPPER', price: 92000, qty: 0, image: '<?= base_url('assets/cuticle-nipper.png') ?>' },
                         { id: 'cuticle_pusher', name: 'CUTICLE PUSHER', price: 3000, qty: 1, image: '<?= base_url('assets/cuticle-pusher.png') ?>' }
                     ];
                     localStorage.setItem('cartItems', JSON.stringify(initialItems));
                     return initialItems;
                 }
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
            const items = JSON.parse(localStorage.getItem('cartItems') || '[]');
            const count = items.reduce((sum, item) => sum + item.qty, 0);
            cartCountBadge.textContent = count;
            if (count > 0) {
                cartCountBadge.classList.remove('hidden');
            } else {
                cartCountBadge.classList.add('hidden');
            }
        }

        /** Menambah 1 kuantitas produk ke keranjang (dipanggil dari tombol plus di accessories). */
        function incrementCart(productId, productDetails) {
            let items = JSON.parse(localStorage.getItem('cartItems') || '[]');
            let existingItem = items.find(item => item.id === productId);

            // Cek apakah item sudah ada, dan jika ada, cek apakah kuantitas > 0
            if (existingItem && existingItem.qty > 0) {
                existingItem.qty += 1;
            } else {
                 // Jika tidak ada atau qty 0, buat/perbarui
                const productFound = dummyProducts.find(p => p.id === productId);
                if (productFound) {
                     const imagePath = `<?= base_url() ?>${productFound.image}`;
                     if (existingItem) {
                        existingItem.qty = 1;
                        existingItem.image = imagePath; // Update image path
                     } else {
                        items.push({ 
                            id: productId, 
                            name: productDetails.name, 
                            price: productDetails.price, 
                            image: imagePath, 
                            qty: 1 
                        });
                     }
                }
            }
            
            // Hapus item dengan qty 0
            items = items.filter(item => item.qty > 0);

            saveCartData(items);
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
            
            // Ambil semua tombol plus di halaman accessories
            const addToCartButtons = document.querySelectorAll('.add-to-cart-button'); 

            // Panggil fungsi untuk mengatur nav active
            setActiveNavAndTitle();
            // Panggil fungsi untuk memuat hitungan keranjang awal
            updateCartBadge(); 

            // Event Listener untuk tombol Add to Cart (di accessories.php)
            addToCartButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const productCard = button.closest('.product-card');
                    if (!productCard) return;

                    const allCards = Array.from(document.querySelectorAll('.product-card'));
                    const productIndex = allCards.indexOf(productCard);

                    const productData = dummyProducts[productIndex]; 
                    
                    if (productData) {
                        incrementCart(productData.id, productData); 
                    } else {
                        console.error('Data produk tidak ditemukan untuk indeks ini:', productIndex);
                        alert('Error: Data produk tidak ditemukan untuk ditambahkan ke keranjang.');
                    }
                });
            });


            if (isLoggedIn) {
                // Tampilan SETELAH LOGIN: Tampilkan ikon user, sembunyikan ikon login
                userTrigger.classList.remove('hidden'); 
                btnShowLoginModal.classList.add('hidden'); 
                
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

                // Profile link (Arahkan ke URL CodeIgniter)
                const btnProfile = document.getElementById('btn-profile');
                if (btnProfile) {
                    btnProfile.addEventListener('click', function() {
                        window.location.href = '<?= site_url("profil") ?>';
                    });
                }


            } else {
                // Tampilan SEBELUM LOGIN: Sembunyikan ikon user, tampilkan ikon login
                userTrigger.classList.add('hidden'); 
                btnShowLoginModal.classList.remove('hidden'); 
                
                // Show modal event
                btnShowLoginModal.addEventListener('click', function(e) {
                    e.preventDefault();
                    openModal();
                });
                
                // Login form submit event
                if (loginForm) {
                    loginForm.addEventListener('submit', handleLogin);
                }
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