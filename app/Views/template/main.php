<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>
        <?= $header ?> -
        <?= session("app_laundry_nama") ?>
    </title>
    <link href="<?= base_url() ?>assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.min.css">
    <?= $this->renderSection("css") ?>
</head>

<body id="body" class="sb-nav-fixed">
    <?= $this->include("template/navbar") ?>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <?= $this->include("template/sidebar") ?>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <?= $this->include("template/breadcrumb") ?>
                    <?= $this->renderSection("main") ?>
                </div>
            </main>
            <?= $this->include("template/footer") ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.all.min.js"></script>
    <script src="<?= base_url() ?>assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function ready(callback) {
            if (document.readyState != 'loading') callback();
            else if (document.addEventListener) document.addEventListener('DOMContentLoaded', callback);
            else document.attachEvent('onreadystatechange', function () {
                if (document.readyState == 'complete') callback();
            })
        };

        ready(function () {
            <?php if (session()->get("pberhasil")): ?>
                Swal.fire(
                    'Berhasil',
                    '<?= session()->get("pberhasil") ?>',
                    'success'
                )
            <?php endif ?>
            <?php if (session()->get("pgagal")): ?>
                Swal.fire(
                    'Gagal',
                    '<?= session()->get("pgagal") ?>',
                    'error'
                )
            <?php endif ?>
        })
    </script>
    <?= $this->renderSection("js") ?>
</body>

</html>