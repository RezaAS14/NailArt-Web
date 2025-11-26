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
// Detail page for accessories -> Accessories controller
$routes->get('/accessories/detail', 'Accessories::detail');
// Cuticle Pusher detail
$routes->get('/accessories/cuticle-pusher', 'Accessories::cuticlePusher');
// Cuticle Nipper detail
$routes->get('/accessories/cuticle-nipper', 'Accessories::cuticleNipper');
// Nail Brush detail
$routes->get('/accessories/nail-brush', 'Accessories::nailBrush');
// Base Coat detail
$routes->get('/accessories/base-coat', 'Accessories::baseCoat');
// Top Coat detail
$routes->get('/accessories/top-coat', 'Accessories::topCoat');
// Nail Polisher detail
$routes->get('/accessories/nail-polisher', 'Accessories::nailPolisher');
// Glitter detail
$routes->get('/accessories/glitter', 'Accessories::glitter');