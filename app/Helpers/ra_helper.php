<?php

function menu(string $menu, string|array $pilihan, string $kembali = "active"): string
{
    if (!is_array($pilihan)) {
        $pilihan = [$pilihan];
    }

    foreach ($pilihan as $pilih) {
        if ($menu == $pilih)
            return $kembali;
    }

    return "";
}

?>