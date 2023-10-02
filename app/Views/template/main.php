<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="<?= base_url() ?>assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <?= $this->renderSection("js") ?>
</head>

<body class="sb-nav-fixed">
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
    <script src="<?= base_url() ?>assetsjs/scripts.js"></script>
    <?= $this->renderSection("js") ?>
</body>

</html>