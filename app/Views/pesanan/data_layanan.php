<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th style="width: 0%;">#</th>
                <th>Nama Layanan</th>
                <th>Harga Satuan</th>
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
                        <div class="btn-group">
                            <button onclick="tambahPesanan(<?= $dt->id_layanan ?>)" class="btn btn-primary btn-sm"
                                data-bs-toggle="modal" data-bs-target="#modaltampil">Tambah</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>