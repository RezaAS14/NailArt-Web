<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/models', 'Home::models');
$routes->get('/daftar', 'Home::daftar');
$routes->get('/accessories', 'Home::accessories');
$routes->get('/gallery', 'Home::gallery');
$routes->get('/profile', 'Home::profil');
// Indonesian route variation for profile page
$routes->get('/profil', 'Home::profil');
$routes->get('/keranjang', 'Home::keranjang');

// --- Perubahan untuk Detail Produk Aksesori ---

// Nail File detail
$routes->get('/accessories/detail_nail_file', 'Accessories::detail'); // Menggunakan method 'detail' untuk Nail File (sesuai controller)
// Cuticle Pusher detail
$routes->get('/accessories/detail_cuticle_pusher', 'Accessories::cuticlePusher');
// Cuticle Nipper detail
$routes->get('/accessories/detail_cuticle_nipper', 'Accessories::cuticleNipper');
// Nail Brush detail
$routes->get('/accessories/detail_nail_brush', 'Accessories::nailBrush');
// Base Coat detail
$routes->get('/accessories/detail_base_coat', 'Accessories::baseCoat');
// Top Coat detail
$routes->get('/accessories/detail_top_coat', 'Accessories::topCoat');
// Nail Polisher detail
$routes->get('/accessories/detail_nail_polisher', 'Accessories::nailPolisher');
// Glitter detail
$routes->get('/accessories/detail_glitter', 'Accessories::glitter');

// Rute lama yang tidak digunakan (opsional dihapus jika sudah diganti di atas)
// $routes->get('/accessories/detail', 'Accessories::detail'); 
// $routes->get('/accessories/cuticle-pusher', 'Accessories::cuticlePusher');
// ... dan seterusnya untuk rute lama lainnya