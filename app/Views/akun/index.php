<?= $this->extend("template/main") ?>

<?= $this->section("main") ?>
<?= form_open(url_to("akun")) ?>
<div class="card">
    <div class="card-header">
        Pengaturan Akun
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <label for="id_user" class="col-sm-2 col-form-label">ID Akun</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="id_user" name="id_user"
                    value="<?= set_value("id_user", session("app_user_id")) ?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="nama_user" class="col-sm-2 col-form-label">Nama Akun</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama_user" name="nama_user"
                    value="<?= set_value("nama_user", session("app_user_nama")) ?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" name="password"
                    value="<?= set_value("password") ?>" required>
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