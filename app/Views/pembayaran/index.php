<?= $this->extend("template/main") ?>

<?= $this->section("main") ?>
<div class="card mb-3">
    <div class="card-header">
        Data Transaksi
    </div>
    <div class="card-body" id="tampildatatransaksi">
    </div>
</div>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-10 pb-2">
                Data Pembayaran
            </div>
            <div class="col-md-2 d-grid gap-2 pb-2">
                <button type="button" class="btn btn-sm btn-block btn-primary" data-bs-toggle="modal"
                    data-bs-target="#modaltampil" onclick="tambahPembayaran()">
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
<?= $this->endSection() ?>

<?= $this->section("css") ?>
<?= $this->endSection() ?>

<?= $this->section("js") ?>
<script>
    // Inisialisasi

    const modalElement = document.getElementById("modaltampil");
    const modal = new bootstrap.Modal(modalElement);

    function ready(callback) {
        if (document.readyState != 'loading') callback();
        else if (document.addEventListener) document.addEventListener('DOMContentLoaded', callback);
        else document.attachEvent('onreadystatechange', function () {
            if (document.readyState == 'complete') callback();
        })
    };

    async function dataPembayaran() {
        try {
            const response = await axios.post('<?= site_url("pembayaran/data/$idTransaksi") ?>');
            document.querySelector("#tampildata").innerHTML = response.data;
        } catch (error) {
            console.error(error);
        }
    }

    async function dataTransaksi() {
        try {
            const response = await axios.post('<?= site_url("pembayaran/datatransaksi/$idTransaksi") ?>');
            document.querySelector("#tampildatatransaksi").innerHTML = response.data;
        } catch (error) {
            console.error(error);
        }
    }

    async function tambahPembayaran() {
        try {
            const response = await axios.post('<?= site_url("pembayaran/tambah/$idTransaksi") ?>');
            document.querySelector("#isimodal").innerHTML = response.data;
        } catch (error) {
            console.error(error);
        }
    }

    async function ubahPembayaran(id) {
        try {
            const response = await axios.post('<?= site_url("pembayaran/ubah") ?>/' + id.toString());
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
                deletePembayaran(id);
                Swal.fire(
                    'Dihapus',
                    'Data berhasil dihapus',
                    'success'
                )
            }
        })
    }

    async function createPembayaran() {
        const onklik = sebelumSimpan();
        try {
            const data = ambilDataForm();
            const response = await axios.post('<?= site_url("api/pembayaran/$idTransaksi") ?>', data);
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

    async function updatePembayaran(id) {
        const onklik = sebelumSimpan();
        try {
            const data = ambilDataForm();
            const response = await axios.patch('<?= site_url("api/pembayaran/$idTransaksi") ?>/' + id.toString(), data);
            perubahanData();
            modal.toggle();
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data berhasil disimpan',
                timer: 3000,
            });
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

    async function deletePembayaran(id) {
        try {
            const response = await axios.delete('<?= site_url("api/pembayaran/$idTransaksi") ?>/' + id.toString());
            perubahanData();
        } catch (error) {
            console.error(error);
        }
    }

    function perubahanData() {
        dataPembayaran();
        dataTransaksi();
    }


    function ambilDataForm() {
        id_transaksi = document.querySelector("#id_transaksi").value;
        tanggal_pembayaran = document.querySelector("#tanggal_pembayaran").value;
        banyak = document.querySelector("#banyak").value;
        keterangan = document.querySelector("#keterangan").value;
        const dataForm = {
            id_transaksi: id_transaksi,
            tanggal_pembayaran: tanggal_pembayaran,
            banyak: banyak,
            keterangan: keterangan,
        }

        return dataForm;
    }

    ready(function () {
        perubahanData();
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