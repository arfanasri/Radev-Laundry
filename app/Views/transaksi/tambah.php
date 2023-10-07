<div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pelanggan</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="mb-3">
        <label for="id_pelanggan" class="form-label">Nama Pelanggan</label>
        <select class="form-control" id="id_pelanggan">
            <?php foreach ($pelanggan as $dt): ?>
                <option value="<?= $dt["id_pelanggan"] ?>">
                    <?= $dt["nama_pelanggan"] ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary" id="tombolsimpan" onclick="createTransaksi()">Simpan</button>
</div>