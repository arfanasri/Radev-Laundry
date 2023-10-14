<?php

if (!function_exists('jenkel')) {
    /**
     * Menampilan Jenis Kelamin dengan String Yang Sering
     * Dibuat di Rahfan
     * 
     * @param string $jenkel "L" | "P"
     * 
     * @return string Laki-Laki | Perempuan | Lainnya
     */
    function jenkel(string $jenkel = null): string
    {
        if ($jenkel == "L") {
            return "Laki-laki";
        } else if ($jenkel == "P") {
            return "Perempuan";
        } else {
            return "Lainnya";
        }
    }
}

if (!function_exists('sama')) {
    /**
     * Mengetahui apakah nilai variabel A dan variabel B sama
     * 
     * @param mixed $a  Variabel A
     * @param mixed $b  Variabel B
     * 
     * @return bool True | False
     */

    function sama($a, $b): bool
    {
        if ($a == $b) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('ada')) {
    /**
     * Mencari apakah dalam string tersebut ada kata yang dicari
     * 
     * @param string $string    String yang ingin dicari
     * @param string $cari  Data yang mau dicari
     * 
     * @return bool True | False
     */

    function ada(string $string, string $cari): bool
    {
        if (strpos($string, $cari) !== false) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('menu')) {
    /**
     * Biasa digunakan pada Menu yang menggunakan Bootstrap
     * 
     * @param mixed $menu       Data menu pada menu tersebut bisa String bisa pula Array
     * @param string $pilih     Menu yang sekarang terpilih
     * @param string $tampil    String yang akan ditampilkan
     * 
     * @return void|string      Akan mengembalikan data Tampil jika benar
     */
    function menu($menu, string $pilih, string $tampil = "active")
    {
        if (is_array($menu)) {
            foreach ($menu as $me) {
                if ($me == $pilih) {
                    return $tampil;
                }
            }
        } else {
            if ($menu == $pilih) {
                return $tampil;
            }
        }
    }
}

if (!function_exists('penyebut')) {
    /**
     * Menampilkan string penyebut dari nilai
     * 
     * @param int $nilai    Nilai yang ingin dijadikan penyebut
     * 
     * @return string Penyebut
     */
    function penyebut(int $nilai): string
    {
        $nilai = abs($nilai);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " " . $huruf[$nilai];
        } else if ($nilai < 20) {
            $temp = penyebut($nilai - 10) . " belas";
        } else if ($nilai < 100) {
            $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
        }
        return $temp;
    }
}

if (!function_exists('terbilang')) {
    /**
     * Menampilkan Nilai Terbilang dari angka
     * 
     * @param int $nilai    Nilai yang ingin dijadikan terbilang
     * 
     * @return string   Hasil terbilang
     */
    function terbilang(int $nilai): string
    {
        if ($nilai < 0) {
            $hasil = "minus " . trim(penyebut($nilai));
        } else {
            $hasil = trim(penyebut($nilai));
        }
        return ucwords($hasil . ' Rupiah');
    }
}

if (!function_exists('agama')) {
    /**
     * Menampilak Nama Agama dari Signkatan
     * 
     * @param string $id Singkatan Agama
     * 
     * @return string Kepanjangan Agama
     */
    function agama(string $id): string
    {
        return match ($id) {
            'is' => "Islam",
            'kp' => "Kristen Protestan",
            'kk' => "Kristen Katolik",
            'hi' => "Hindu",
            'bu' => "Budha",
            'kh' => "Kong Hu Cu",
            default => "Lainnya",
        };
    }
}

if (!function_exists('rupiah')) {
    /** 
     * Menampilkan Nilai Rupiah
     * 
     * @param int $id Masukkan Nilai Rupiah
     * 
     * @return string Nilai dengan format rupiah
     */
    function rupiah(int $id): string
    {
        return "Rp&nbsp;" . number_format($id, 0, ',', '.');
    }
}

if (!function_exists('normalkan')) {
    function normalkan(string $string): string
    {
        $string = str_replace("_", "&nbsp;", $string);
        return ucwords($string);
    }
}