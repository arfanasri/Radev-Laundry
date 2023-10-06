<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Layanan</th>
                <th>Harga</th>
                <th>Satuan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1 ?>
            <?php foreach ($layanan as $dt): ?>
                <tr>
                    <td>
                        <?= $no++ ?>
                    </td>
                    <td>
                        <?= $dt['nama_layanan'] ?>
                    </td>
                    <td>
                        <?= $dt['harga'] ?>
                    </td>
                    <td>
                        <?= $dt['satuan'] ?>
                    </td>
                    <td>
                        <button onclick="ubahLayanan(<?= $dt['id_layanan'] ?>)" class="btn btn-info btn-sm"
                            data-bs-toggle="modal" data-bs-target="#modaltampil">Ubah</button>
                        <button onclick="konfirmasiHapus(<?= $dt['id_layanan'] ?>)"
                            class="btn btn-danger btn-sm">Hapus</button>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>