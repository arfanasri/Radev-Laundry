<?= $this->extend("template/main") ?>

<?= $this->section("main") ?>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-4 pb-2">
                Data Transaksi
            </div>
            <div class="col-md-6 pb-2">
                <div class="row">
                    <label for="cari" class="col-sm-2 col-form-label">Cari :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="cari" placeholder="Cari"
                            onchange="cariTransaksi(this.value)">
                    </div>
                </div>
            </div>
            <div class="col-md-2 d-grid gap-2 pb-2">
                <button type="button" class="btn btn-sm btn-block btn-primary" data-bs-toggle="modal"
                    data-bs-target="#modaltampil" onclick="tambahTransaksi()">
                    Tambah
                </button>
            </div>
        </div>
    </div>
    <div class="card-body" id="tampildata">
    </div>
    <div class="card-footer d-flex justify-content-center">
        <nav>
            <ul class="pagination">
                <?php for ($i = 1; $i <= $banyakHalaman; $i++): ?>
                    <?php if ($i == 1): ?>
                        <li class="page-item active" onclick="dataTransaksi(<?= $i ?>);setAktif(event)"><button
                                class="page-link">
                                <?= $i ?>
                            </button>
                        </li>
                    <?php else: ?>
                        <li class="page-item" onclick="dataTransaksi(<?= $i ?>);setAktif(event)"><button class="page-link">
                                <?= $i ?>
                            </button></li>
                    <?php endif ?>
                <?php endfor ?>
            </ul>
        </nav>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modaltampil" tabindex="-1" aria-labelledby="modaltampilLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" id="isimodal">
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section("css") ?>
<?= $this->endSection() ?>

<?= $this->section("js") ?>
<script>
    // Inisialisasi
    var HALAMAN_SEKARANG = 1;
    var DATA_SEKARANG = 1; // 1 : Halaman, 2 : Cari

    const modalElement = document.getElementById("modaltampil");
    const modal = new bootstrap.Modal(modalElement);

    function ready(callback) {
        if (document.readyState != 'loading') callback();
        else if (document.addEventListener) document.addEventListener('DOMContentLoaded', callback);
        else document.attachEvent('onreadystatechange', function () {
            if (document.readyState == 'complete') callback();
        })
    };

    async function dataTransaksi(halaman) {
        try {
            const response = await axios.post('<?= site_url("transaksi/halaman") ?>/' + halaman.toString());
            document.querySelector("#tampildata").innerHTML = response.data;
            HALAMAN_SEKARANG = halaman;
            DATA_SEKARANG = 1;
        } catch (error) {
            console.error(error);
        }
    }

    async function cariTransaksi(cari) {
        if (cari == "") {
            dataTransaksi(1);
            DATA_SEKARANG = 1;
        } else {
            try {
                const response = await axios.post('<?= site_url("transaksi/cari") ?>/' + cari.toString());
                document.querySelector("#tampildata").innerHTML = response.data;
                DATA_SEKARANG = 2;
            } catch (error) {
                console.error(error);
            }
        }
    }

    async function tambahTransaksi() {
        try {
            const response = await axios.post('<?= url_to("transaksi.tambah") ?>');
            document.querySelector("#isimodal").innerHTML = response.data;
        } catch (error) {
            console.error(error);
        }
    }

    function konfirmasiHapus(id) {
        Swal.fire({
            title: 'Apakah anda yakin ingin menghapus data ini?',
            text: "Data yang telah dihapus tidak dapat dikembalikan",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                deleteTransaksi(id);
                Swal.fire(
                    'Dihapus',
                    'Data berhasil dihapus',
                    'success'
                )
            }
        })
    }

    async function createTransaksi() {
        const onklik = sebelumSimpan();
        try {
            const data = ambilDataForm();
            const response = await axios.post('<?= url_to("api/transaksi") ?>', data);
            modal.toggle();
            perubahanData();
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data berhasil disimpan',
                timer: 3000,
            });
        } catch (error) {
            console.error(error);
            Swal.fire({
                position: 'top',
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: JSON.stringify(error.response.data.messages),
                showConfirmButton: false,
                timer: 5000,
                toast: true,
            });
        }
        setelahSimpan(onklik);
    }

    async function deleteTransaksi(id) {
        try {
            const response = await axios.delete('<?= url_to("api/transaksi") ?>/' + id.toString());
            perubahanData();
        } catch (error) {
            console.error(error);
        }
    }

    function tombolCari() {
        const cari = document.querySelector("#cari").value;
        cariTransaksi(cari);
    }

    function perubahanData() {
        if (DATA_SEKARANG == 1) {
            dataTransaksi(HALAMAN_SEKARANG);
        } else if (DATA_SEKARANG == 2) {
            tombolCari();
        }
    }


    function ambilDataForm() {
        id_pelanggan = document.querySelector("#id_pelanggan").value;
        const dataForm = {
            id_pelanggan: id_pelanggan,
        }

        return dataForm;
    }

    ready(function () {
        dataTransaksi(HALAMAN_SEKARANG);
    })

    // Global Function yang akan dipindahkan dalam 1 file nanti

    function sebelumSimpan() {
        const onklik = document.querySelector('#tombolsimpan').getAttribute('onclick');
        document.querySelector('#tombolsimpan').setAttribute('disable', 'disabled');
        document.querySelector('#tombolsimpan').removeAttribute('onclick');
        document.querySelector('#tombolsimpan').innerHTML = '<i class="fas fa-spin fa-spinner"></i>';
        return onklik
    }

    function setelahSimpan(onklik) {
        document.querySelector('#tombolsimpan').setAttribute('onclick', onklik);
        document.querySelector('#tombolsimpan').removeAttribute('disable');
        document.querySelector('#tombolsimpan').innerHTML = 'Simpan';
    }

    function setAktif(e) {
        const klass = document.getElementsByClassName(e.currentTarget.className);

        for (i = 0; i < klass.length; i++) {
            klass[i].setAttribute("class", "page-item");
        }

        e.currentTarget.setAttribute("class", "page-item active");
    }

</script>
<?= $this->endSection() ?>