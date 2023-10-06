<?= $this->extend("template/main") ?>

<?= $this->section("main") ?>
<div class="card">
    <div class="card-header">Data Layanan

        <!-- Button trigger modal -->
        <div class="float-end">
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modaltampil"
                onclick="tambahLayanan()">
                Tambah
            </button>
        </div>
    </div>
    <div class="card-body" id="tampildata">
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
    function ready(callback) {
        if (document.readyState != 'loading') callback();
        else if (document.addEventListener) document.addEventListener('DOMContentLoaded', callback);
        else document.attachEvent('onreadystatechange', function () {
            if (document.readyState == 'complete') callback();
        })
    };

    async function dataLayanan() {
        try {
            const response = await axios.post('<?= url_to("layanan.data") ?>');
            document.querySelector("#tampildata").innerHTML = response.data;
        } catch (error) {
            console.error(error);
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
            dataLayanan();
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
            dataLayanan();
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
            dataLayanan();
        } catch (error) {
            console.error(error);
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

    function bersihkanDataForm() {
        document.querySelector("#nama_layanan").value = "";
        document.querySelector("#harga").value = "";
        document.querySelector("#satuan").value = "";
    }

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

    ready(function () {
        dataLayanan();
    })



</script>
<?= $this->endSection() ?>