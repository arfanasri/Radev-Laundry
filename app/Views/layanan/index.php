<?= $this->extend("template/main") ?>

<?= $this->section("main") ?>
<div class="card">
    <div class="card-header">Data Layanan

        <!-- Button trigger modal -->
        <div class="float-end">
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modaltampil"
                onclick="tambahLayanan()">
                Tambah Layanan
            </button>
        </div>
    </div>
    <div class="card-body" id="tampildata">
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modaltampil" tabindex="-1" aria-labelledby="modaltampilLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="isimodal">
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section("css") ?>
<?= $this->endSection() ?>

<?= $this->section("js") ?>
<script>
    async function dataLayanan() {
        try {
            const response = await axios.post('<?= url_to("layanan.data") ?>');
            $("#tampildata").html(response.data);
        } catch (error) {
            console.error(error);
        }
    }

    async function tambahLayanan() {
        try {
            const response = await axios.post('<?= url_to("layanan.tambah") ?>');
            $("#isimodal").html(response.data);
        } catch (error) {
            console.error(error);
        }
    }

    async function buatLayanan() {
        try {
            sebelumSimpan();
            const data = ambilDataForm();
            const response = await axios.post('<?= url_to("api/layanan") ?>', data);
            setelahSimpan();
            $("#modaltampil").modal("hide");
            dataLayanan();
        } catch (error) {
            setelahSimpan();
            console.error(error);
        }
    }

    function ambilDataForm() {
        nama_layanan = $("#nama_layanan").value;
        harga = $("#harga").value;
        satuan = $("#satuan").value;
        const dataForm = {
            nama_layanan: nama_layanan,
            harga: harga,
            satuan: satuan,
        }

        return dataForm;
    }

    function sebelumSimpan() {
        $('#tombolsimpan').attr('disable', 'disabled');
        $('#tombolsimpan').html('<i class=" . '" fas fa-spin fa-spinner"' . "></i>');
    }

    function setelahSimpan() {
        $('#tombolsimpan').removeAttr('disable');
        $('#tombolsimpan').html('Simpan');
    }

    $(document).ready(function () {
        dataLayanan();
    });


</script>
<?= $this->endSection() ?>