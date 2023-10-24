<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th style="width: 0%;">#</th>
                <th>ID Transaksi</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal</th>
                <th>Harga Total</th>
                <th>Status</th>
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
            <?php foreach ($transaksi as $dt): ?>
                <tr>
                    <td>
                        <?= $no++ ?>
                    </td>
                    <td>
                        <?= $dt->id_transaksi ?>
                    </td>
                    <td>
                        <?= $dt->nama_pelanggan ?>
                    </td>
                    <td>
                        <?= $dt->tanggal_transaksi ?>
                    </td>
                    <td>
                        <?= rupiah($dt->harga_total) ?>
                    </td>
                    <td>
                        <?= normalkan($dt->status) ?>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a class="btn btn-light btn-sm" target="_blank"
                                href="<?= url_to("transaksi.nota", $dt->id_transaksi) ?>">Cetak</a>
                            <?php if ($dt->status == "pencatatan"): ?>
                                <a class="btn btn-success btn-sm"
                                    href="<?= url_to("pesanan", $dt->id_transaksi) ?>">Pesanan</a>
                            <?php endif ?>
                            <?php if ($dt->status != "selesai"): ?>
                                <a class="btn btn-info btn-sm"
                                    href="<?= url_to("pembayaran", $dt->id_transaksi) ?>">Pembayaran</a>
                            <?php endif ?>

                            <?php if ($dt->status == "pencatatan"): ?>
                                <button onclick="konfirmasiStatus(<?= $dt->id_transaksi ?>,'antrian')"
                                    class="btn btn-primary btn-sm">Antrian</button>
                            <?php elseif ($dt->status == 'antrian'): ?>
                                <button onclick="konfirmasiStatus(<?= $dt->id_transaksi ?>,'proses')"
                                    class="btn btn-primary btn-sm">Proses</button>
                            <?php elseif ($dt->status == 'proses'): ?>
                                <button onclick="konfirmasiStatus(<?= $dt->id_transaksi ?>,'siap_diambil')"
                                    class="btn btn-primary btn-sm">Siap diambil</button>
                            <?php elseif ($dt->status == 'siap_diambil'): ?>
                                <button onclick="konfirmasiStatus(<?= $dt->id_transaksi ?>,'selesai')"
                                    class="btn btn-primary btn-sm">Selesai</button>
                            <?php endif ?>

                            <?php if ($dt->status == 'batal'): ?>
                                <button onclick="konfirmasiStatus(<?= $dt->id_transaksi ?>,'pencatatan')"
                                    class="btn btn-warning btn-sm">Ulang</button>
                            <?php else: ?>
                                <button onclick="konfirmasiStatus(<?= $dt->id_transaksi ?>,'batal')"
                                    class="btn btn-warning btn-sm">Batal</button>
                            <?php endif ?>

                            <button onclick="konfirmasiHapus(<?= $dt->id_transaksi ?>)"
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
    "namaTombol" => "Transaksi",
]) ?>