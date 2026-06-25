<?= $this->include('template/header'); ?>
<article class="entry-detail">
    <h2><?= $artikel['judul']; ?></h2>
    <p><strong>Kategori: <?= $artikel['nama_kategori']; ?></strong></p>
    
    <?php if (!empty($artikel['gambar'])): ?>
        <img src="<?= base_url('/gambar/' . $artikel['gambar']); ?>" alt="<?= $artikel['judul']; ?>">
    <?php endif; ?>
    <p><?= $artikel['isi']; ?></p>
</article>
<?= $this->include('template/footer'); ?>