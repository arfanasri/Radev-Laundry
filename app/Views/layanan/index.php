<?= $this->extend("template/main") ?>

<?= $this->section("main") ?>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 pb-2">
                Data Layanan
            </div>
            <div class="col-md-2 d-grid gap-2 pb-2">
                <select class="form-control" id="pilihan_halaman" onchange="gantiLimit(this.value)">
                    <option value="5">5 / Halaman</option>
                    <option selected value="10">10 / Halaman</option>
                    <option value="20">20 / Halaman</option>
                    <option value="50">50 / Halaman</option>
                    <option value="100">100 / Halaman</option>
                </select>
            </div>
            <div class="col-md-2 d-grid gap-2 pb-2">
                <button type="button" class="btn btn-sm btn-block btn-primary" data-bs-toggle="modal"
                    data-bs-target="#modalcari">
                    Cari
                </button>
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
        <div class="container">
            <div class="row justify-content-center my-5">
                <div class="col-12 text-center my-5">
                    <div id="rotating-gear"><i class="fas fa-cog fa-spin fa-3x"></i>
                        <h2>Memuat Halaman</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modaltampil" tabindex="-1" aria-labelledby="modaltampilLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" id="isimodal">
        </div>
    </div>
</div>

<!-- Modal Cari -->
<div class="modal fade" id="modalcari" tabindex="-1" aria-labelledby="modalcariLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalCariLabel">Cari Layanan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3 px-3">
                    <input type="text" class="form-control" id="cariData" placeholder="Data yang ingin dicari">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger" onclick="tombolBersihCari()">Bersihkan</button>
                <button type="button" class="btn btn-primary" onclick="tombolCari()">Cari</button>
            </div>
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
    var LIMIT = 10;

    const modalElement = document.getElementById("modaltampil");
    const modal = new bootstrap.Modal(modalElement);

    function gantiLimit(limitData) {
        LIMIT = limitData;
        perubahanData();
    }

    function ready(callback) {
        if (document.readyState != 'loading') callback();
        else if (document.addEventListener) document.addEventListener('DOMContentLoaded', callback);
        else document.attachEvent('onreadystatechange', function () {
            if (document.readyState == 'complete') callback();
        })
    };

    async function dataLayanan(halaman, limit = 50) {
        try {
            const response = await axios.post('<?= site_url("layanan/halaman") ?>/' + halaman.toString() + '/' + limit.toString());
            document.querySelector("#tampildata").innerHTML = response.data;
            HALAMAN_SEKARANG = halaman;
            DATA_SEKARANG = 1;
        } catch (error) {
            console.error(error);
        }
    }

    async function cariLayanan(cari, halaman, limit = 10) {
        if (cari == "") {
            dataLayanan(1, LIMIT);
            DATA_SEKARANG = 1;
        } else {
            try {
                const response = await axios.post('<?= site_url("layanan/cari") ?>/' + cari.toString() + '/' + halaman.toString() + '/' + limit.toString());
                document.querySelector("#tampildata").innerHTML = response.data;
                HALAMAN_SEKARANG = halaman;
                DATA_SEKARANG = 2;
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
            perubahanData();
            modal.toggle();
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

    async function updateLayanan(id) {
        const onklik = sebelumSimpan();
        try {
            const data = ambilDataForm();
            const response = await axios.patch('<?= url_to("api/layanan") ?>/' + id.toString(), data);
            perubahanData();
            modal.toggle();
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

    async function deleteLayanan(id) {
        try {
            const response = await axios.delete('<?= url_to("api/layanan") ?>/' + id.toString());
            perubahanData();
        } catch (error) {
            console.error(error);
        }
    }

    function tombolCari(halaman = 1) {
        const cari = document.querySelector("#cariData").value;
        cariLayanan(cari, halaman, LIMIT);
    }

    function tombolBersihCari() {
        document.querySelector("#cariData").value = "";
        cariLayanan("", halaman, LIMIT);
    }

    function perubahanData() {
        if (DATA_SEKARANG == 1) {
            dataLayanan(HALAMAN_SEKARANG, LIMIT);
        } else if (DATA_SEKARANG == 2) {
            tombolCari(HALAMAN_SEKARANG);
        }
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

    ready(function () {
        dataLayanan(HALAMAN_SEKARANG, LIMIT);
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

</script>
<?= $this->endSection() ?>