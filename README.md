# Radev Laundry

## Fitur

1. Pengelolaan Layanan
2. Pengelolaan Pelanggan
3. Pengelolaan Transaksi
4. Pengelolaan Pembayaran Transaksi
5. Pencetakan Nota

### Fitur yang akan datang

1. Pengelolaan Keuangan
2. Laporan Transaksi
3. ...

Akan ditambahkan seiring waktu

## Instalasi

### Kebutuhan Server

1. PHP 7.4 atau Lebih tinggi dengan fitur `intl`, `json`, `mysqlnd` dan `mbstring` yang aktif
2. Database Mysql atau MariaDB

### Cara Instalasi

1. Download atau Clone Git ini
2. Buka directory Radev-Laundry
3. Buka Terminal
4. Install dependensi menggunakan `composer install`
5. Salin file `env` menjadi `.env`
6. Edit file `.env` cari bagian database dan ubah seluruh `database.default` sesuai database yang anda miliki
7. Buka Terminal dan masukkan `php spark migrate`
8. Jika ingin mengisi dengan data kosong gunakan perintah `php spark db:seed blankseeder`
9. Jika ingin mengisi dengan data dummy gunakan perintah `php spark db:seed startseeder`

### Cara menjalankan

1. Buka terminal
2. Ketikkan `php spark serve`
3. Buka browser `http://localhost:8080`
4. Masukkan id admin default yakni id/username = `admin` dan password = `admin`

## Kontribusi

Jika Anda ingin berkontribusi pada proyek ini, kami sangat menghargainya. Berikut beberapa yang dapat Anda lakukan:

1. Laporkan [issue](https://github.com/arfanasri/Radev-Laundry/issues) jika Anda menemui kesalahan atau bug.
2. Sampaikan [diskusi](https://github.com/arfanasri/Radev-Laundry/discussions) jika Anda ingin mengusulkan fitur baru atau perubahan pada fitur yang sudah ada.
3. Ajukan [pull request](https://github.com/arfanasri/Radev-Laundry/pulls) untuk perbaikan bug, penambahan fitur baru, atau perbaikan label.

## Lisensi
Radev Laundry merupakan perangkat lunak open-source yang dilisensikan dibawah [Lisensi MIT](LICENSE)