<div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pesanan
        <?= $layanan->nama_layanan ?>
    </h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="number" class="form-control" id="harga" onchange="ubahHarga()" value="<?= $layanan->harga ?>">
    </div>
    <div class="mb-3">
        <label for="banyak" class="form-label">Banyak</label>
        <input type="number" class="form-control" id="banyak" onchange="ubahHarga()" value="1">
    </div>
    <div class="mb-3">
        <label for="harga_subtotal" class="form-label">Subtotal</label>
        <input type="number" class="form-control" id="harga_subtotal" onchange="ubahTotal()"
            value="<?= $layanan->harga ?>">
    </div>
</div>
<div class="modal-footer">
    <input type="hidden" id="id_transaksi" value="<?= $idTransaksi ?>">
    <input type="hidden" id="id_layanan" value="<?= $layanan->id_layanan ?>">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary" id="tombolsimpan" onclick="createPesanan()">Simpan</button>
</div>