<div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Pembayaran</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="mb-3">
        <label for="tanggal_pembayaran" class="form-label">Tanggal Pembayaran</label>
        <input type="datetime-local" class="form-control" id="tanggal_pembayaran"
            value="<?= $data["tanggal_pembayaran"] ?>">
    </div>
    <div class="mb-3">
        <label for="banyak" class="form-label">Banyak</label>
        <input type="number" class="form-control" id="banyak" value="<?= $data["banyak"] ?>">
    </div>
    <div class="mb-3">
        <label for="keterangan" class="form-label">Keterangan</label>
        <input type="text" class="form-control" id="keterangan" value="<?= $data["keterangan"] ?>">
    </div>
</div>
<div class="modal-footer">
    <input type="hidden" id="id_transaksi" value="<?= $idTransaksi ?>">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary" id="tombolsimpan"
        onclick="updatePembayaran(<?= $data['id_pembayaran'] ?>)">Simpan</button>
</div>