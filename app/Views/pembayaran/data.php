<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th style="width: 0%;">#</th>
                <th>Tanggal Pembayaran</th>
                <th>Banyak</th>
                <th>Keterangan</th>
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
            <?php foreach ($pembayaran as $dt): ?>
                <tr>
                    <td>
                        <?= $no++ ?>
                    </td>
                    <td>
                        <?= $dt->tanggal_pembayaran ?>
                    </td>
                    <td>
                        <?= rupiah($dt->banyak) ?>
                    </td>
                    <td>
                        <?= $dt->keterangan ?>
                    </td>
                    <td>
                        <div class="btn-group">
                            <button onclick="ubahPembayaran(<?= $dt->id_pembayaran ?>)" class="btn btn-info btn-sm"
                                data-bs-toggle="modal" data-bs-target="#modaltampil">Ubah</button>
                            <button onclick="konfirmasiHapus(<?= $dt->id_pembayaran ?>)"
                                class="btn btn-danger btn-sm">Hapus</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>