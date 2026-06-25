<?= $this->include('template/admin_header'); ?>

<h2><?= $title; ?></h2>

<div class="row mb-3">
    <div class="col-md-6">
        <form id="search-form" class="form-inline">
            <input type="text" name="q" id="search-box" value="<?= $q; ?>" placeholder="Cari judul artikel..." class="form-control mr-2">
            
            <select name="kategori_id" id="category-filter" class="form-control mr-2">
                <option value="">Semua Kategori</option>
                <?php foreach ($kategori as $k): ?>
                    <option value="<?= $k['id_kategori']; ?>" <?= ($kategori_id == $k['id_kategori']) ? 'selected' : ''; ?>>
                        <?= $k['nama_kategori']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            
            <input type="submit" value="Cari" class="btn btn-primary">
        </form>
    </div>
</div>

<div id="article-container"></div>
<div id="pagination-container"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    const articleContainer = $('#article-container');
    const paginationContainer = $('#pagination-container');
    const searchForm = $('#search-form');
    const searchBox = $('#search-box');
    const categoryFilter = $('#category-filter');

    const fetchData = (url) => {
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            // Tugas: Tambahan indikator loading
            beforeSend: function() {
                articleContainer.html('<p class="text-center text-primary mt-4"><em>Sedang memuat data artikel...</em></p>');
            },
            success: function(data) {
                renderArticles(data.artikel);
                // Cek apakah pager tersedia
                if (data.pager && data.pager.links) {
                    renderPagination(data.pager, data.q, data.kategori_id);
                } else {
                    paginationContainer.html('');
                }
            },
            error: function() {
                articleContainer.html('<p class="text-center text-danger mt-4">Gagal memuat data dari server.</p>');
            }
        });
    };

    const renderArticles = (articles) => {
        let html = '<table class="table table-bordered table-hover">';
        html += '<thead class="thead-dark"><tr><th>ID</th><th>Judul</th><th>Kategori</th><th>Status</th><th>Aksi</th></tr></thead><tbody>';

        if (articles.length > 0) {
            articles.forEach(article => {
                // Menangani jika isi artikel kosong/null
                let isiArtikel = article.isi ? article.isi.substring(0, 50) : 'Tidak ada isi';
                let kategori = article.nama_kategori ? article.nama_kategori : '-';
                
                html += `
                <tr>
                    <td>${article.id}</td>
                    <td>
                        <b>${article.judul}</b>
                        <p><small>${isiArtikel}...</small></p>
                    </td>
                    <td>${kategori}</td>
                    <td>${article.status == 1 ? 'Publish' : 'Draft'}</td>
                    <td>
                        <a class="btn btn-sm btn-info" href="/admin/artikel/edit/${article.id}">Ubah</a>
                        <a class="btn btn-sm btn-danger" onclick="return confirm('Yakin menghapus data?');" href="/admin/artikel/delete/${article.id}">Hapus</a>
                    </td>
                </tr>
                `;
            });
        } else {
            html += '<tr><td colspan="5" class="text-center">Tidak ada data ditemukan.</td></tr>';
        }

        html += '</tbody></table>';
        articleContainer.html(html);
    };

    const renderPagination = (pager, q, kategori_id) => {
        let html = '<nav><ul class="pagination">';
        
        pager.links.forEach(link => {
            let url = link.url ? `${link.url}&q=${q}&kategori_id=${kategori_id}` : '#';
            let activeClass = link.active ? 'active' : '';
            html += `<li class="page-item ${activeClass}"><a class="page-link" href="${url}">${link.title}</a></li>`;
        });
        
        html += '</ul></nav>';
        paginationContainer.html(html);
    };

    // Event saat form pencarian disubmit (ditekan enter/klik tombol)
    searchForm.on('submit', function(e) {
        e.preventDefault();
        const q = searchBox.val();
        const kategori_id = categoryFilter.val();
        fetchData(`/admin/artikel?q=${q}&kategori_id=${kategori_id}`);
    });

    // Event saat dropdown kategori diubah
    categoryFilter.on('change', function() {
        searchForm.trigger('submit');
    });

    // Pemuatan awal saat halaman pertama kali dibuka
    fetchData('/admin/artikel');
});
</script>

<?= $this->include('template/admin_footer'); ?>