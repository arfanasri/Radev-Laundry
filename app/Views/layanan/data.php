<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th style="width: 0%;">#</th>
                <th>Nama Layanan</th>
                <th>Harga</th>
                <th>Satuan</th>
                <th style="width: 0%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($halaman)) {
                $no = $offset + 1;
            } else {
                $no = 1;
            }
            ?>
            <?php foreach ($layanan as $dt): ?>
                <tr>
                    <td>
                        <?= $no++ ?>
                    </td>
                    <td>
                        <?= $dt->nama_layanan ?>
                    </td>
                    <td>
                        <?= rupiah($dt->harga) ?>
                    </td>
                    <td>
                        <?= $dt->satuan ?>
                    </td>
                    <td>
                        <div class="btn-group">
                            <button onclick="ubahLayanan(<?= $dt->id_layanan ?>)" class="btn btn-info btn-sm"
                                data-bs-toggle="modal" data-bs-target="#modaltampil">Ubah</button>
                            <button onclick="konfirmasiHapus(<?= $dt->id_layanan ?>)"
                                class="btn btn-danger btn-sm">Hapus</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<?= view_cell("NavigationCell", [
    "banyakHalaman" => $banyakHalaman,
    "halaman" => $halaman,
    "mode" => $mode,
    "cari" => (isset($cari)) ? $cari : "",
    "limit" => $limit,
    "namaTombol" => "Layanan",
]) ?>