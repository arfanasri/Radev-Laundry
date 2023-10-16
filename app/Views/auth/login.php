<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - SB Admin</title>
    <link href="<?= base_url() ?>assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.min.css">
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 mt-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">
                                    <?= form_open(url_to("loginproses")) ?>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="id" type="text" name="id"
                                            value="<?= set_value("id") ?>" />
                                        <label for="id">ID / Username</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="password" type="password" name="password"
                                            value="<?= set_value("password") ?>" />
                                        <label for="password">Password</label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <button class="btn btn-primary" type="submit">Login</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.all.min.js"></script>
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
</body>

</html>