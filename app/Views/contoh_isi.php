<?= $this->extend("template/main") ?>

<?= $this->section("main") ?>
<div class="row mb-3">
    <a href="<?= url_to("layanan") ?>" class="col-4 text-decoration-none">
        <div class="card bg-primary py-3 text-white">
            <div class="card-body fs-5">
                <div class="float-end"><i class="fas fa-xl fa-shirt"></i></div>
                Layanan :
                <?= session("app_beranda_banyak_layanan") ?>
            </div>
        </div>
    </a>
    <a href="<?= url_to("pelanggan") ?>" class="col-4 text-decoration-none">
        <div class="card bg-info py-3 text-white">
            <div class="card-body fs-5">
                <div class="float-end"><i class="fas fa-xl fa-user-tie"></i></div>
                Pelanggan :
                <?= session("app_beranda_banyak_pelanggan") ?>
            </div>
        </div>
    </a>
    <a href="<?= url_to("transaksi") ?>" class="col-4 text-decoration-none">
        <div class="card bg-success py-3 text-white">
            <div class="card-body fs-5">
                <div class="float-end"><i class="fas fa-xl fa-cart-shopping"></i></div>
                Transaksi :
                <?= session("app_beranda_banyak_transaksi") ?>
            </div>
        </div>
    </a>
</div>
<canvas id="myChart"></canvas>
<?= $this->endSection() ?>

<?= $this->section("css") ?>
<?= $this->endSection() ?>

<?= $this->section("js") ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode(session("app_beranda_banyak_transaksi_harian_tanggal")) ?>,
            datasets: [{
                label: '# banyak transaksi',
                data: <?= json_encode(session("app_beranda_banyak_transaksi_harian_banyak")) ?>,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

</script>
<?= $this->endSection() ?>