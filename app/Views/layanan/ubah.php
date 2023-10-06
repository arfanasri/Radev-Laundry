<div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Layanan</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="mb-3">
        <label for="nama_layanan" class="form-label">Nama Layanan</label>
        <input type="text" class="form-control" id="nama_layanan" value="<?= $data['nama_layanan'] ?>">
    </div>
    <div class="mb-3">
        <label for="harga" class="form-label">Harga Layanan</label>
        <input type="number" class="form-control" id="harga" value="<?= $data['harga'] ?>">
    </div>
    <div class="mb-3">
        <label for="satuan" class="form-label">Satuan Layanan</label>
        <input type="text" class="form-control" id="satuan" value="<?= $data['satuan'] ?>">
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary" id="tombolsimpan"
        onclick="perbaruiLayanan(<?= $data['id_layanan'] ?>)">Simpan</button>
</div>