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
                <th>Aksi</th>
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
                        <?= $dt['id_transaksi'] ?>
                    </td>
                    <td>
                        <?= $dt['nama_pelanggan'] ?>
                    </td>
                    <td>
                        <?= $dt['tanggal_transaksi'] ?>
                    </td>
                    <td>
                        <?= $dt['harga_total'] ?>
                    </td>
                    <td>
                        <?= $dt['status'] ?>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a class="btn btn-success btn-sm" href="<?= url_to("pesanan", $dt["id_transaksi"]) ?>">Lihat</a>
                            <button onclick="konfirmasiHapus(<?= $dt['id_transaksi'] ?>)"
                                class="btn btn-danger btn-sm">Hapus</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>