<?= $this->extend("template/main") ?>

<?= $this->section("main") ?>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-5 pb-2">
                        Data Layanan
                    </div>
                    <div class="col-md-7 pb-2">
                        <div class="row">
                            <label for="carilayanan" class="col-sm-4 col-form-label">Cari :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="carilayanan" placeholder="Cari"
                                    onchange="cariLayanan(this.value)">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body" id="tampildatalayanan">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-5 pb-2">
                        Data Pesanan
                    </div>
                    <div class="col-md-7 pb-2">
                        <div class="row">
                            <label for="caripesanan" class="col-sm-4 col-form-label">Cari :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="caripesanan" placeholder="Cari"
                                    onchange="cariPesanan(this.value)">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body" id="tampildatapesanan">
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
    var DATA_SEKARANG_LAYANAN = 1; // 1 : Halaman, 2 : Cari
    var DATA_SEKARANG_PESANAN = 1; // 1 : Halaman, 2 : Cari

    function ready(callback) {
        if (document.readyState != 'loading') callback();
        else if (document.addEventListener) document.addEventListener('DOMContentLoaded', callback);
        else document.attachEvent('onreadystatechange', function () {
            if (document.readyState == 'complete') callback();
        })
    };

    async function dataLayanan() {
        try {
            const response = await axios.post('<?= site_url("pesanan/datalayanan") ?>');
            document.querySelector("#tampildatalayanan").innerHTML = response.data;
            DATA_SEKARANG_LAYANAN = 1;
        } catch (error) {
            console.error(error);
        }
    }

    async function dataPesanan() {
        try {
            const response = await axios.post('<?= site_url("pesanan/data/$idTransaksi") ?>');
            document.querySelector("#tampildatapesanan").innerHTML = response.data;
            DATA_SEKARANG_PESANAN = 1;
        } catch (error) {
            console.error(error);
        }
    }

    async function cariLayanan(cari) {
        if (cari == "") {
            dataLayanan();
            DATA_SEKARANG_LAYANAN = 1;
        } else {
            try {
                const response = await axios.post('<?= site_url("pesanan/carilayanan") ?>/' + cari.toString());
                document.querySelector("#tampildatalayanan").innerHTML = response.data;
                DATA_SEKARANG_LAYANAN = 2;
            } catch (error) {
                console.error(error);
            }
        }
    }

    async function cariPesanan(cari) {
        if (cari == "") {
            dataPesanan();
            DATA_SEKARANG_PESANAN = 1;
        } else {
            try {
                const response = await axios.post('<?= site_url("pesanan/cari/$idTransaksi") ?>/' + cari.toString());
                document.querySelector("#tampildatapesanan").innerHTML = response.data;
                DATA_SEKARANG_PESANAN = 2;
            } catch (error) {
                console.error(error);
            }
        }
    }

    async function tambahPesanan(idLayanan) {
        try {
            const response = await axios.post('<?= site_url("pesanan/tambah/$idTransaksi") ?>/' + idLayanan.toString());
            document.querySelector("#isimodal").innerHTML = response.data;
        } catch (error) {
            console.error(error);
        }
    }

    async function ubahPesanan(id) {
        try {
            const response = await axios.post('<?= site_url("pesanan/ubah") ?>/' + id.toString());
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
                deletePesanan(id);
                Swal.fire(
                    'Dihapus',
                    'Data berhasil dihapus',
                    'success'
                )
            }
        })
    }

    async function createPesanan() {
        const onklik = sebelumSimpan();
        try {
            const data = ambilDataForm();
            const response = await axios.post('<?= site_url("api/pesanan/$idTransaksi") ?>', data);
            bersihkanDataForm();
            perubahanData();
            Swal.fire({
                position: 'top',
                icon: 'success',
                title: 'Berhasil',
                text: 'Data berhasil disimpan',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
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

    async function updatePesanan(id) {
        const onklik = sebelumSimpan();
        try {
            const data = ambilDataForm();
            const response = await axios.patch('<?= site_url("api/pesanan/$idTransaksi") ?>/' + id.toString(), data);
            perubahanData();
            Swal.fire({
                position: 'top',
                icon: 'success',
                title: 'Berhasil',
                text: 'Data berhasil disimpan',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
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

    async function deletePesanan(id) {
        try {
            const response = await axios.delete('<?= site_url("api/pesanan/$idTransaksi") ?>/' + id.toString());
            perubahanData();
        } catch (error) {
            console.error(error);
        }
    }

    function tombolCari() {
        const cari = document.querySelector("#caripesanan").value;
        cariPesanan(cari);
    }

    function perubahanData() {
        if (DATA_SEKARANG_PESANAN == 1) {
            dataPesanan();
        } else if (DATA_SEKARANG_PESANAN == 2) {
            tombolCari();
        }
    }


    function ambilDataForm() {
        const id_transaksi = document.querySelector("#id_transaksi").value;
        const id_layanan = document.querySelector("#id_layanan").value;
        const banyak = document.querySelector("#banyak").value;
        const harga = document.querySelector("#harga").value;
        const harga_subtotal = document.querySelector("#harga_subtotal").value;
        const dataForm = {
            id_transaksi: id_transaksi,
            id_layanan: id_layanan,
            banyak: banyak,
            harga: harga,
            harga_subtotal: harga_subtotal,
        }

        return dataForm;
    }

    function bersihkanDataForm() {
        document.querySelector("#id_transaksi").value = "";
        document.querySelector("#id_layanan").value = "";
        document.querySelector("#banyak").value = "";
        document.querySelector("#harga").value = "";
        document.querySelector("#harga_subtotal").value = "";
    }

    ready(function () {
        dataPesanan();
        dataLayanan();
    })

    function ubahHarga() {
        const harga = parseInt(document.querySelector("#harga").value);
        const banyak = parseInt(document.querySelector("#banyak").value);
        const harga_subtotal = banyak * harga;
        document.querySelector("#harga_subtotal").value = harga_subtotal.toString();
    }

    function ubahTotal() {
        const harga_subtotal = parseInt(document.querySelector("#harga_subtotal").value);
        const banyak = parseInt(document.querySelector("#banyak").value);
        const harga = harga_subtotal / banyak;
        document.querySelector("#harga").value = harga.toString();
    }

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