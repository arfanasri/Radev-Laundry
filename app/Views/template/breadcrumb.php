<h1 class="mt-4">
    <?= $header ?>
</h1>
<ol class="breadcrumb mb-4">
    <?php foreach ($bc as $dt): ?>
        <?php if (is_array($dt)): ?>
            <li class="breadcrumb-item">
                <a href="<?= url_to($dt[0]) ?>">
                    <?= $dt[1] ?>
                </a>
            </li>
        <?php else: ?>
            <li class="breadcrumb-item active">
                <?= $dt ?>
            </li>
        <?php endif ?>
    <?php endforeach ?>
</ol>