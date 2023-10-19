<div class="pt-3">
    <nav class="d-flex justify-content-center">
        <ul class="pagination">
            <?php if ($banyakHalaman > 10): ?>
                <!-- Halaman Pertama -->
                <?php $tombol = $mode == "halaman" ? "data$namaTombol(1, $limit)" : "cari$namaTombol('$cari', 1, $limit)"; ?>
                <?php if (1 == $halaman): ?>
                    <li class="page-item active" onclick="<?= $tombol ?>"><button class="page-link">
                            <?= 1 ?>
                        </button>
                    </li>
                <?php else: ?>
                    <li class="page-item" onclick="<?= $tombol ?>"><button class="page-link">
                            <?= 1 ?>
                        </button></li>
                <?php endif ?>
                <?php if ($halaman > 4): ?>
                    <li class="page-item disabled"><button class="page-link">
                            ...
                        </button>
                    </li>
                <?php endif ?>

                <!-- Pertengahan Halaman -->
                <?php for ($i = $halaman - 3; $i <= $halaman + 3; $i++): ?>
                    <?php $tombol = $mode == "halaman" ? "data$namaTombol($i, $limit)" : "cari$namaTombol('$cari', $i, $limit)"; ?>
                    <?php if ($i <= 1 or $i >= $banyakHalaman): ?>
                    <?php else: ?>
                        <?php if ($i == $halaman): ?>
                            <li class="page-item active" onclick="<?= $tombol ?>"><button class="page-link">
                                    <?= $i ?>
                                </button>
                            </li>
                        <?php else: ?>
                            <li class="page-item" onclick="<?= $tombol ?>"><button class="page-link">
                                    <?= $i ?>
                                </button></li>
                        <?php endif ?>
                    <?php endif ?>
                <?php endfor ?>

                <!-- Halaman Terakhir -->
                <?php if ($halaman < $banyakHalaman - 4): ?>
                    <li class="page-item disabled"><button class="page-link">
                            ...
                        </button>
                    </li>
                <?php endif ?>
                <?php $tombol = $mode == "halaman" ? "data$namaTombol($banyakHalaman, $limit)" : "cari$namaTombol('$cari', $banyakHalaman, $limit)"; ?>
                <?php if ($banyakHalaman == $halaman): ?>
                    <li class="page-item active" onclick="<?= $tombol ?>"><button class="page-link">
                            <?= $banyakHalaman ?>
                        </button>
                    </li>
                <?php else: ?>
                    <li class="page-item" onclick="<?= $tombol ?>"><button class="page-link">
                            <?= $banyakHalaman ?>
                        </button></li>
                <?php endif ?>
                </li>

            <?php else: ?>
                <?php for ($i = 1; $i <= $banyakHalaman; $i++): ?>
                    <?php $tombol = $mode == "halaman" ? "data$namaTombol($i, $limit)" : "cari$namaTombol('$cari', $i, $limit)"; ?>
                    <?php if ($i == $halaman): ?>
                        <li class="page-item active" onclick="<?= $tombol ?>"><button class="page-link">
                                <?= $i ?>
                            </button>
                        </li>
                    <?php else: ?>
                        <li class="page-item" onclick="<?= $tombol ?>"><button class="page-link">
                                <?= $i ?>
                            </button></li>
                    <?php endif ?>
                <?php endfor ?>
            <?php endif ?>
        </ul>
    </nav>
</div>