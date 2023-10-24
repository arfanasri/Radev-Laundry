<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th style="width: 0%;">#</th>
                <th>ID User</th>
                <th>Nama</th>
                <th style="width: 0%">Aksi</th>
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
            <?php foreach ($user as $dt): ?>
                <tr>
                    <td>
                        <?= $no++ ?>
                    </td>
                    <td>
                        <?= $dt->id_user ?>
                    </td>
                    <td>
                        <?= $dt->nama_user ?>
                    </td>
                    <td>
                        <div class="btn-group">
                            <button onclick="ubahUser('<?= $dt->id_user ?>')" class="btn btn-info btn-sm"
                                data-bs-toggle="modal" data-bs-target="#modaltampil">Ubah</button>
                            <button onclick="konfirmasiHapus('<?= $dt->id_user ?>')"
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
    "namaTombol" => "User",
]) ?>