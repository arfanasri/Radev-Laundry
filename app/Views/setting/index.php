<?= $this->extend("template/main") ?>

<?= $this->section("main") ?>
<?= form_open(url_to("setting")) ?>
<div class="card">
    <div class="card-header">
        Pengaturan Aplikasi
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <label for="nama_laundry" class="col-sm-2 col-form-label">Nama Laundry</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama_laundry" name="nama_laundry"
                    value="<?= set_value("nama_laundry", $namaLaundry) ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="alamat_laundry" class="col-sm-2 col-form-label">Alamat Laundry</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="alamat_laundry" name="alamat_laundry"
                    value="<?= set_value("alamat_laundry", $alamatLaundry) ?>">
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</div>
<?= form_close() ?>
<?= $this->endSection() ?>

<?= $this->section("css") ?>
<?= $this->endSection() ?>

<?= $this->section("js") ?>
<?= $this->endSection() ?>