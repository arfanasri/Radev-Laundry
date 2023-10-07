<div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pelanggan</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="mb-3">
        <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
        <input type="text" class="form-control" id="nama_pelanggan">
    </div>
    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat Pelanggan</label>
        <input type="text" class="form-control" id="alamat">
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary" id="tombolsimpan" onclick="createPelanggan()">Simpan</button>
</div>