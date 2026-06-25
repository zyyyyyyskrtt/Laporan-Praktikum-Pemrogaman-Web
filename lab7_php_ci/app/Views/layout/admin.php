<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Admin' ?></title>
    <link rel="stylesheet" href="<?= base_url('/admin.css');?>">
</head>
<body>
<div id="container">
    <header>
        <h1>Admin Portal Berita</h1>
    </header>
    <nav>
        <a href="<?= base_url('/admin/artikel');?>">Dashboard</a>
        <a href="<?= base_url('/admin/artikel');?>">Artikel</a>
        <a href="<?= base_url('/admin/artikel/add');?>">Tambah Artikel</a>
    </nav>
    <section id="wrapper">
        <section id="main">

            <?= $this->renderSection('content') ?>

        </section>
    </section>
    <footer>
        <p>&copy; 2021 - Universitas Pelita Bangsa</p>
    </footer>
</div>
</body>
</html>