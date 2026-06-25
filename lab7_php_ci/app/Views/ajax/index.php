<?= $this->include('template/admin_header'); ?>

<h2><?= $title; ?></h2>
<table class="table" id="artikelTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        </tbody>
</table>

<script src="<?= base_url('assets/js/jquery-4.0.0.min.js') ?>"></script>

<script>
$(document).ready(function() {
    
    // Fungsi untuk menampilkan tulisan Loading
    function showLoadingMessage() {
        $('#artikelTable tbody').html('<tr><td colspan="4" style="text-align:center;">Loading data...</td></tr>');
    }

    // Fungsi utama mengambil data
    function loadData() {
        showLoadingMessage();
        
        $.ajax({
            url: "<?= base_url('ajax/getData') ?>",
            method: "GET",
            dataType: "json",
            success: function(data) {
                var tableBody = "";
                // Looping data yang didapat dari database
                for (var i = 0; i < data.length; i++) {
                    var row = data[i];
                    tableBody += '<tr>';
                    tableBody += '<td>' + row.id + '</td>';
                    tableBody += '<td><b>' + row.judul + '</b></td>';
                    tableBody += '<td>' + row.status + '</td>';
                    tableBody += '<td>';
                    // Tombol Edit mengarah ke halaman edit biasa
                    tableBody += '<a href="<?= base_url('admin/artikel/edit/') ?>' + row.id + '" class="btn btn-sm btn-info">Ubah</a> ';
                    // Tombol Hapus (Trigger AJAX)
                    tableBody += '<a href="#" class="btn btn-sm btn-danger btn-delete" data-id="' + row.id + '">Hapus</a>';
                    tableBody += '</td>';
                    tableBody += '</tr>';
                }
                
                // Tempelkan data ke dalam tbody
                $('#artikelTable tbody').html(tableBody);
            }
        });
    }

    // Panggil fungsi loadData() pertama kali halaman dibuka
    loadData();

    // Fungsi jika tombol "Hapus" diklik
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        var id = $(this).data('id'); // Mengambil ID dari atribut data-id
        
        if (confirm('Apakah Anda yakin ingin menghapus artikel ini?')) {
            $.ajax({
                // Mengirim request DELETE ke AjaxController
                url: "<?= base_url('ajax/delete/') ?>" + id,
                method: "DELETE",
                success: function(data) {
                    // Jika sukses, reload tabel tanpa refresh halaman!
                    loadData(); 
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Error menghapus artikel: ' + textStatus + ' ' + errorThrown);
                }
            });
        }
    });

});
</script>

<?= $this->include('template/admin_footer'); ?>