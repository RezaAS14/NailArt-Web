<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['filter' => 'userfilter']);
$routes->get('/about', 'Home::about', ['filter' => 'userfilter']);
$routes->get('/models', 'Home::models', ['filter' => 'userfilter']);
$routes->get('/daftar', 'Home::daftar', ['filter' => 'userfilter']);
$routes->get('/accessories', 'Home::accessories', ['filter' => 'userfilter']);
$routes->get('/gallery', 'Home::gallery', ['filter' => 'userfilter']);
$routes->get('/profil', 'Home::profil', ['filter' => 'userfilter']);
$routes->post('/profil/update', 'Home::updateProfile', ['filter' => 'userfilter']);
$routes->get('/keranjang', 'Home::keranjang', ['filter' => 'userfilter']);

// --- AJAX Routes untuk Keranjang ---
$routes->post('/cart/add', 'Home::addToCart', ['filter' => 'userfilter']);
$routes->get('/cart/get', 'Home::getCartData', ['filter' => 'userfilter']);
$routes->post('/cart/update', 'Home::updateCart', ['filter' => 'userfilter']);
$routes->post('/cart/remove', 'Home::removeCart', ['filter' => 'userfilter']);
$routes->post('/checkout/process', 'Home::processCheckout', ['filter' => 'userfilter']);

// --- Detail Produk Aksesori (Frontend) ---
$routes->get('/accessories/detail/(:num)', 'Home::detailAccessory/$1', ['filter' => 'userfilter']);

// --- Rute Admin ---
$routes->group('admin', ['filter' => 'adminfilter'], function($routes) {
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
    $routes->post('checkout/updateStatus', 'Admin::updatePesananStatus');
});

// *** Rute Login, Register dan Logout ***
$routes->post('/auth/do_login', 'Auth::do_login');
$routes->post('/auth/do_register', 'Auth::do_register');
$routes->get('/auth/logout', 'Auth::logout');