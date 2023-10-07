<?= $this->extend("template/main") ?>

<?= $this->section("main") ?>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-4 pb-2">
                Data Layanan
            </div>
            <div class="col-md-6 pb-2">
                <div class="row">
                    <label for="cari" class="col-sm-2 col-form-label">Cari :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="cari" placeholder="Cari"
                            onchange="cariLayanan(this.value)">
                    </div>
                </div>
            </div>
            <div class="col-md-2 d-grid gap-2 pb-2">
                <button type="button" class="btn btn-sm btn-block btn-primary" data-bs-toggle="modal"
                    data-bs-target="#modaltampil" onclick="tambahLayanan()">
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
                        <li class="page-item active" onclick="dataLayanan(<?= $i ?>);setAktif(event)"><button class="page-link">
                                <?= $i ?>
                            </button>
                        </li>
                    <?php else: ?>
                        <li class="page-item" onclick="dataLayanan(<?= $i ?>);setAktif(event)"><button class="page-link">
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
    var HALAMAN_SEKARANG = 1;

    function ready(callback) {
        if (document.readyState != 'loading') callback();
        else if (document.addEventListener) document.addEventListener('DOMContentLoaded', callback);
        else document.attachEvent('onreadystatechange', function () {
            if (document.readyState == 'complete') callback();
        })
    };

    async function dataLayanan(halaman) {
        try {
            const response = await axios.post('<?= site_url("layanan/halaman") ?>/' + halaman.toString());
            document.querySelector("#tampildata").innerHTML = response.data;
            HALAMAN_SEKARANG = halaman;
        } catch (error) {
            console.error(error);
        }
    }

    async function cariLayanan(cari) {
        console.log(cari);
        if (cari == "") {
            dataLayanan(1);
        } else {
            try {
                const response = await axios.post('<?= site_url("layanan/cari") ?>/' + cari.toString());
                document.querySelector("#tampildata").innerHTML = response.data;
            } catch (error) {
                console.error(error);
            }
        }
    }

    async function tambahLayanan() {
        try {
            const response = await axios.post('<?= url_to("layanan.tambah") ?>');
            document.querySelector("#isimodal").innerHTML = response.data;
        } catch (error) {
            console.error(error);
        }
    }

    async function ubahLayanan(id) {
        try {
            const response = await axios.post('<?= site_url("layanan/ubah") ?>/' + id.toString());
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
                deleteLayanan(id);
                Swal.fire(
                    'Dihapus',
                    'Data berhasil dihapus',
                    'success'
                )
            }
        })
    }

    async function createLayanan() {
        const onklik = sebelumSimpan();
        try {
            const data = ambilDataForm();
            const response = await axios.post('<?= url_to("api/layanan") ?>', data);
            bersihkanDataForm();
            dataLayanan(HALAMAN_SEKARANG);
        } catch (error) {
            Swal.fire({
                position: 'top',
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: JSON.stringify(error.response.data.messages),
                showConfirmButton: false,
                timer: 5000,
                toast: true,
            });
            console.error(error);
        }
        setelahSimpan(onklik);
    }

    async function updateLayanan(id) {
        const onklik = sebelumSimpan();
        try {
            const data = ambilDataForm();
            const response = await axios.patch('<?= url_to("api/layanan") ?>/' + id.toString(), data);
            dataLayanan(HALAMAN_SEKARANG);
        } catch (error) {
            Swal.fire({
                position: 'top',
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: JSON.stringify(error.response.data.messages),
                showConfirmButton: false,
                timer: 5000,
                toast: true,
            });
            console.error(error);
        }
        setelahSimpan(onklik);
    }

    async function deleteLayanan(id) {
        try {
            const response = await axios.delete('<?= url_to("api/layanan") ?>/' + id.toString());
            dataLayanan(HALAMAN_SEKARANG);
        } catch (error) {
            console.error(error);
        }
    }

    function tombolCari() {
        const cari = document.querySelector("#cari").value;
        cariLayanan(cari);
    }

    function ambilDataForm() {
        nama_layanan = document.querySelector("#nama_layanan").value;
        harga = document.querySelector("#harga").value;
        satuan = document.querySelector("#satuan").value;
        const dataForm = {
            nama_layanan: nama_layanan,
            harga: harga,
            satuan: satuan,
        }

        return dataForm;
    }

    function bersihkanDataForm() {
        document.querySelector("#nama_layanan").value = "";
        document.querySelector("#harga").value = "";
        document.querySelector("#satuan").value = "";
    }

    ready(function () {
        dataLayanan(HALAMAN_SEKARANG);
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