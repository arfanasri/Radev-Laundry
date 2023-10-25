<div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="mb-3">
        <label for="id_user" class="form-label">ID User</label>
        <input type="text" class="form-control" id="id_user">
    </div>
    <div class="mb-3">
        <label for="nama_user" class="form-label">Nama User</label>
        <input type="text" class="form-control" id="nama_user">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password">
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary" id="tombolsimpan" onclick="createUser()">Simpan</button>
</div>