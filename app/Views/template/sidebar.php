<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link <?= menu($menu, "beranda") ?>" href="<?= url_to("/") ?>">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Beranda
            </a>
            <a class="nav-link <?= menu($menu, "layanan") ?>" href="<?= url_to("layanan") ?>">
                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                Layanan
            </a>
            <a class="nav-link <?= menu($menu, "pelanggan") ?>" href="<?= url_to("pelanggan") ?>">
                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                Pelanggan
            </a>
            <a class="nav-link <?= menu($menu, "transaksi") ?>" href="<?= url_to("transaksi") ?>">
                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                Transaksi
            </a>
            <!-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Layouts
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="layout-static.html">Static Navigation</a>
                    <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                </nav>
            </div> -->
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        Start Bootstrap
    </div>
</nav>