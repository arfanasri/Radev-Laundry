<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('api', ['namespace' => 'App\Controllers\Api'], static function ($routes) {
    // Layanan
    $routes->get("layanan/page/(:segment)/(:segment)", "Layanan::page/$1/$2");
    $routes->get("layanan/search/(:segment)", "Layanan::search/$1");
    $routes->resource('layanan');
    // Pelanggan
    $routes->get("pelanggan/page/(:segment)/(:segment)", "Pelanggan::page/$1/$2");
    $routes->get("pelanggan/search/(:segment)", "Pelanggan::search/$1");
    $routes->resource('pelanggan');
    // Transaksi
    $routes->get("transaksi/page/(:segment)/(:segment)", "Transaksi::page/$1/$2");
    $routes->get("transaksi/search/(:segment)", "Transaksi::search/$1");
    $routes->patch('transaksi/status/(:segment)/(:segment)', 'Transaksi::status/$1/$2');
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

// Layanan
$routes->get("layanan", "Layanan::index", ["as" => "layanan"]);
$routes->post("layanan", "Layanan::data", ["as" => "layanan.data"]);
$routes->post("layanan/halaman/(:segment)/(:segment)", "Layanan::halaman/$1/$2", ["as" => "layanan.halaman.limit"]);
$routes->post("layanan/cari/(:segment)", "Layanan::cari/$1", ["as" => "layanan.cari"]);
$routes->post("layanan/halaman/(:segment)", "Layanan::halaman/$1", ["as" => "layanan.halaman"]);
$routes->post("layanan/tambah", "Layanan::tambah", ["as" => "layanan.tambah"]);
$routes->post("layanan/ubah/(:segment)", "Layanan::ubah/$1", ["as" => "layanan.ubah"]);

// Pelanggan
$routes->get("pelanggan", "Pelanggan::index", ["as" => "pelanggan"]);
$routes->post("pelanggan", "Pelanggan::data", ["as" => "pelanggan.data"]);
$routes->post("pelanggan/halaman/(:segment)/(:segment)", "Pelanggan::halaman/$1/$2", ["as" => "pelanggan.halaman.limit"]);
$routes->post("pelanggan/cari/(:segment)", "Pelanggan::cari/$1", ["as" => "pelanggan.cari"]);
$routes->post("pelanggan/halaman/(:segment)", "Pelanggan::halaman/$1", ["as" => "pelanggan.halaman"]);
$routes->post("pelanggan/tambah", "Pelanggan::tambah", ["as" => "pelanggan.tambah"]);
$routes->post("pelanggan/ubah/(:segment)", "Pelanggan::ubah/$1", ["as" => "pelanggan.ubah"]);

// Transaksi
$routes->get("transaksi", "Transaksi::index", ["as" => "transaksi"]);
$routes->get("transaksi/nota/(:segment)", "Transaksi::nota/$1", ["as" => "transaksi.nota"]);
$routes->post("transaksi", "Transaksi::data", ["as" => "transaksi.data"]);
$routes->post("transaksi/halaman/(:segment)/(:segment)", "Transaksi::halaman/$1/$2", ["as" => "transaksi.halaman.limit"]);
$routes->post("transaksi/cari/(:segment)", "Transaksi::cari/$1", ["as" => "transaksi.cari"]);
$routes->post("transaksi/halaman/(:segment)", "Transaksi::halaman/$1", ["as" => "transaksi.halaman"]);
$routes->post("transaksi/tambah", "Transaksi::tambah", ["as" => "transaksi.tambah"]);

// Pesanan
$routes->get("transaksi/(:segment)/pesanan", "Pesanan::transaksi/$1", ["as" => "pesanan"]);
$routes->post("pesanan/data/(:segment)", "Pesanan::data/$1", ["as" => "pesanan.data"]);
$routes->post("pesanan/datalayanan", "Pesanan::dataLayanan", ["as" => "pesanan.datalayanan"]);
$routes->post("pesanan/cari/(:segment)/(:segment)", "Pesanan::cari/$1/$2", ["as" => "pesanan.cari"]);
$routes->post("pesanan/carilayanan/(:segment)", "Pesanan::cariLayanan/$1", ["as" => "pesanan.carilayanan"]);
$routes->post("pesanan/tambah/(:segment)/(:segment)", "Pesanan::tambah/$1/$2", ["as" => "pesanan.tambah"]);
$routes->post("pesanan/ubah/(:segment)", "Pesanan::ubah/$1", ["as" => "pesanan.ubah"]);

// Pembayaran
$routes->get("transaksi/(:segment)/pembayaran", "Pembayaran::transaksi/$1", ["as" => "pembayaran"]);
$routes->post("pembayaran/data/(:segment)", "Pembayaran::data/$1", ["as" => "pembayaran.data"]);
$routes->post("pembayaran/datatransaksi/(:segment)", "Pembayaran::dataTransaksi/$1", ["as" => "pembayaran.datatransaksi"]);
$routes->post("pembayaran/tambah/(:segment)", "Pembayaran::tambah/$1", ["as" => "pembayaran.tambah"]);
$routes->post("pembayaran/ubah/(:segment)", "Pembayaran::ubah/$1", ["as" => "pembayaran.ubah"]);

service('auth')->routes($routes);

$routes->get("test", "Home::test");