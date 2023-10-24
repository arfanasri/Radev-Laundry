<table class="table">
    <tbody>
        <tr>
            <th>ID Transaksi</th>
            <td>
                <?= $transaksi->id_transaksi ?>
            </td>
        </tr>
        <tr>
            <th>Tanggal Transaksi</th>
            <td>
                <?= $transaksi->tanggal_transaksi ?>
            </td>
        </tr>
        <tr>
            <th>Nama Pelanggan</th>
            <td>
                <?= $transaksi->nama_pelanggan ?>
            </td>
        </tr>
        <tr>
            <th>Total Pembayaran</th>
            <td>
                <?= rupiah($transaksi->harga_total) ?>
            </td>
        </tr>
        <tr>
            <th>Sudah Bayar</th>
            <td>
                <?= rupiah($sudahBayar) ?>
            </td>
        </tr>
        <tr>
            <th>Sisa Bayar</th>
            <td>
                <?= rupiah($sisaBayar) ?>
            </td>
        </tr>
    </tbody>
</table>