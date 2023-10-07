<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('api', ['namespace' => 'App\Controllers\Api'], static function ($routes) {
    $routes->get("layanan/page/(:segment)/(:segment)", "Layanan::page/$1/$2");
    $routes->get("layanan/search/(:segment)", "Layanan::page/$1");
    $routes->resource('layanan');
    $routes->resource('pelanggan');
    $routes->resource('transaksi');
    // Pesanan
    $routes->get('pesanan/(:segment)/new', 'Pesanan::new/$1');
    $routes->post('pesanan/(:segment)', 'Pesanan::create/$1');
    $routes->get('pesanan/(:segment)', 'Pesanan::get/$1');
    $routes->get('pesanan/(:segment)/(:segment)', 'Pesanan::show/$1/$2');
    $routes->get('pesanan/(:segment)/(:segment)/edit', 'Pesanan::edit/$1/$2');
    $routes->put('pesanan/(:segment)/(:segment)', 'Pesanan::update/$1/$2');
    $routes->patch('pesanan/(:segment)/(:segment)', 'Pesanan::update/$1/$2');
    $routes->delete('pesanan/(:segment)/(:segment)', 'Pesanan::delete/$1/$2');
    // Pembayaran
    $routes->get('pembayaran/(:segment)/new', 'Pembayaran::new/$1');
    $routes->post('pembayaran/(:segment)', 'Pembayaran::create/$1');
    $routes->get('pembayaran/(:segment)', 'Pembayaran::get/$1');
    $routes->get('pembayaran/(:segment)/(:segment)', 'Pembayaran::show/$1/$2');
    $routes->get('pembayaran/(:segment)/(:segment)/edit', 'Pembayaran::edit/$1/$2');
    $routes->put('pembayaran/(:segment)/(:segment)', 'Pembayaran::update/$1/$2');
    $routes->patch('pembayaran/(:segment)/(:segment)', 'Pembayaran::update/$1/$2');
    $routes->delete('pembayaran/(:segment)/(:segment)', 'Pembayaran::delete/$1/$2');
    // Halaman
});

$routes->get("layanan", "Layanan::index", ["as" => "layanan"]);
$routes->post("layanan", "Layanan::data", ["as" => "layanan.data"]);
$routes->post("layanan/halaman/(:segment)/(:segment)", "Layanan::halaman/$1/$2", ["as" => "layanan.halaman.limit"]);
$routes->post("layanan/cari/(:segment)", "Layanan::cari/$1", ["as" => "layanan.cari"]);
$routes->post("layanan/halaman/(:segment)", "Layanan::halaman/$1", ["as" => "layanan.halaman"]);
$routes->post("layanan/tambah", "Layanan::tambah", ["as" => "layanan.tambah"]);
$routes->post("layanan/ubah/(:segment)", "Layanan::ubah/$1", ["as" => "layanan.ubah"]);