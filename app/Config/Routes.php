<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::starter', ['filter' => 'auth']);

$routes->group('auth', function ($routes) {
    $routes->get('/', 'AuthController::index');
    $routes->post('login', 'AuthController::login');
    $routes->get('logout', 'AuthController::logout');
});

$routes->group('user',  ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'UserController::index');
    $routes->get('create', 'UserController::create');
    $routes->post('add', 'UserController::add');
    $routes->post('update/(:num)', 'UserController::update/$1');
    $routes->get('edit/(:num)', 'UserController::edit/$1');
    $routes->get('delete/(:num)', 'UserController::delete/$1');
});

$routes->group('kategori',  ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'KategoriController::index');
    $routes->post('add', 'KategoriController::add');
    $routes->post('update/(:num)', 'KategoriController::update/$1');
    $routes->get('delete/(:num)', 'KategoriController::delete/$1');
    $routes->get('create', 'KategoriController::create');
    $routes->get('edit/(:num)', 'KategoriController::edit/$1');
});

$routes->group('jenis',  ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'JenisController::index');
    $routes->post('add', 'JenisController::add');
    $routes->post('update/(:num)', 'JenisController::update/$1');
    $routes->get('delete/(:num)', 'JenisController::delete/$1');
    $routes->get('create', 'JenisController::create');
    $routes->get('edit/(:num)', 'JenisController::edit/$1');
});

$routes->group('produk',  ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'ProdukController::index');
    $routes->post('add', 'ProdukController::add');
    $routes->post('update/(:num)', 'ProdukController::update/$1');
    $routes->get('delete/(:num)', 'ProdukController::delete/$1');
    $routes->get('create', 'ProdukController::create');
    $routes->get('edit/(:num)', 'ProdukController::edit/$1');
    $routes->post('cekstok/', 'ProdukController::cekstok');
});

$routes->group('detailproduk', ['filter' => 'auth'], function ($routes) {
    $routes->get('show/(:num)', 'DetailProdukController::show/$1');
    $routes->post('add/(:num)', 'DetailProdukController::add/$1');
    $routes->get('delete/(:num)', 'DetailProdukController::delete/$1');
});

$routes->group('masuk',  ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'MasukController::index');
    $routes->post('add', 'MasukController::add');
    $routes->get('edit/(:num)', 'MasukController::edit/$1');
    $routes->post('update/(:num)', 'MasukController::update/$1');
    $routes->get('delete/(:num)', 'MasukController::delete/$1');
    $routes->get('create', 'MasukController::create');
    $routes->get('edit/(:num)', 'MasukController::edit/$1');
    $routes->get('edit/(:num)', 'MasukController::edit/$1');
});

$routes->group('keluar',  ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'KeluarController::index');
    $routes->post('add', 'KeluarController::add');
    $routes->get('edit/(:num)', 'KeluarController::edit/$1');
    $routes->post('update/(:num)', 'KeluarController::update/$1');
    $routes->get('delete/(:num)', 'KeluarController::delete/$1');
    $routes->get('create', 'KeluarController::create');
    
});
