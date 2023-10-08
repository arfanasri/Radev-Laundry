<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th style="width: 0%;">#</th>
                <th>Nama Layanan</th>
                <th>Banyak</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
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
            <?php foreach ($pesanan as $dt): ?>
                <tr>
                    <td>
                        <?= $no++ ?>
                    </td>
                    <td>
                        <?= $dt['nama_layanan'] ?>
                    </td>
                    <td>
                        <?= $dt['banyak'] ?>
                    </td>
                    <td>
                        <?= $dt['harga'] ?>
                    </td>
                    <td>
                        <?= $dt['harga_subtotal'] ?>
                    </td>
                    <td>
                        <div class="btn-group">
                            <button onclick="ubahPesanan(<?= $dt['id_pesanan'] ?>)" class="btn btn-info btn-sm"
                                data-bs-toggle="modal" data-bs-target="#modaltampil">Ubah</button>
                            <button onclick="konfirmasiHapus(<?= $dt['id_pesanan'] ?>)"
                                class="btn btn-danger btn-sm">Hapus</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>