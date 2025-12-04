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
$routes->get('/profil', 'Home::profil');
$routes->post('/profil/update', 'Home::updateProfile');
$routes->get('/keranjang', 'Home::keranjang');

// --- AJAX Routes untuk Keranjang ---
$routes->post('/cart/add', 'Home::addToCart');
$routes->get('/cart/get', 'Home::getCartData');
$routes->post('/cart/update', 'Home::updateCart');
$routes->post('/cart/remove', 'Home::removeCart');
$routes->post('/checkout/process', 'Home::processCheckout');

// --- Detail Produk Aksesori (Frontend) ---
$routes->get('/accessories/detail/(:num)', 'Home::detailAccessory/$1');

// --- Rute Admin ---
$routes->group('admin', function($routes) {
    $routes->get('dashboard', 'Admin::dashboard'); 
    
    // Gallery Routes
    $routes->get('gallery', 'Admin::gallery'); 
    $routes->post('saveGallery', 'Admin::saveGallery');
    $routes->get('deleteGallery/(:num)', 'Admin::deleteGallery/$1');
    
    // Models Routes
    $routes->get('models', 'Admin::models'); 
    $routes->get('models/add', 'Admin::addModel');
    $routes->get('models/edit/(:num)', 'Admin::editModel/$1');
    $routes->post('models/save', 'Admin::saveModel');
    $routes->get('models/delete/(:num)', 'Admin::deleteModel/$1');
    
    // Accessories Routes
    $routes->get('accessories', 'Admin::accessories'); 
    $routes->get('accessories/add', 'Admin::addAccessory');
    $routes->get('accessories/edit/(:num)', 'Admin::editAccessory/$1');
    $routes->post('accessories/save', 'Admin::saveAccessory');
    $routes->get('accessories/delete/(:num)', 'Admin::deleteAccessory/$1');
    
    // Users Routes
    $routes->get('users', 'Admin::users');
    $routes->get('user/delete/(:num)', 'Admin::deleteUser/$1');
    
    // Checkout Routes
    $routes->get('checkout', 'Admin::checkout'); 
    $routes->get('checkout/detail/(:num)', 'Admin::checkoutDetail/$1');
    $routes->get('checkout/delete/(:num)', 'Admin::deleteCheckout/$1');
});

// *** Rute Login, Register dan Logout ***
$routes->post('/auth/do_login', 'Auth::do_login');
$routes->post('/auth/do_register', 'Auth::do_register');
$routes->get('/auth/logout', 'Auth::logout');