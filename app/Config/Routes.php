<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Variabel Filter
$authFilter = ['filter' => 'auth'];

// Variabel Role
$admin     = ['filter' => 'role:admin'];
$user     = ['filter' => 'role:user'];
$allRole   = ['filter' => 'role:admin, user'];

// Login
$routes->get('/login', 'Auth::login');
$routes->post('/proses-login', 'Auth::prosesLogin');
$routes->get('/logout', 'Auth::logout');

// Halaman utama
$routes->get('/', 'Home::index', $authFilter);
$routes->get('/dashboard', 'Home::index', $authFilter);

$routes->get('/users/create', 'Users::create');  // form tambah user
$routes->post('/users/store', 'Users::store');   // aksi simpan user

$routes->get('/users', 'Users::index', $allRole); // menampilkan data user
$routes->post('/users/update/(:num)', 'Users::update/$1'); // aksi update user
$routes->get('/users/delete/(:num)', 'Users::delete/$1', $allRole); // aksi hapus user

$routes->get('/pengaduan', 'Pengaduan::index');
$routes->get('/pengaduan/create', 'Pengaduan::create');
$routes->post('/pengaduan/store', 'Pengaduan::store');

$routes->get('/pengaduan/edit/(:num)', 'Pengaduan::edit/$1');
$routes->post('/pengaduan/update/(:num)', 'Pengaduan::update/$1');
$routes->get('/pengaduan/delete/(:num)', 'Pengaduan::delete/$1');

$routes->get('/pengaduan/feedback/(:num)', 'Pengaduan::feedback/$1');
$routes->post('/pengaduan/feedback/save', 'Pengaduan::saveFeedback');

$routes->get('/pengaduan/history', 'Pengaduan::history');
$routes->get('/users/edit/(:num)', 'Users::edit/$1');
$routes->post('/users/update/(:num)', 'Users::update/$1');
$routes->get('/pengaduan/kategori/(:num)', 'Pengaduan::perKategori/$1');
$routes->get('users/admin', 'Users::admin');

$routes->get('/', 'Dashboard::index');
$routes->get('dashboard', 'Dashboard::index');