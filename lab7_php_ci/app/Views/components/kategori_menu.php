<div class="widget-box">
    <h3 class="title">Kategori Artikel</h3>
    <ul>
        <?php foreach ($kategori as $k): ?>
            <li>
                <a href="<?= base_url('/artikel/kategori/' . $k['id_kategori']) ?>">
                    <?= $k['nama_kategori'] ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>