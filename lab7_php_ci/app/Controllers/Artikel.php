<?php
namespace App\Controllers;
use App\Models\ArtikelModel;
use App\Models\KategoriModel;

class Artikel extends BaseController
{
    public function admin_index()
    {
        $title = 'Daftar Artikel (Admin)';
        $model = new \App\Models\ArtikelModel();
        
        $q = $this->request->getVar('q') ?? '';
        $kategori_id = $this->request->getVar('kategori_id') ?? '';
        $page = $this->request->getVar('page') ?? 1;

        $builder = $model->table('artikel')
                         ->select('artikel.*, kategori.nama_kategori')
                         ->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left');

        if ($q != '') {
            $builder->like('artikel.judul', $q);
        }
        if ($kategori_id != '') {
            $builder->where('artikel.id_kategori', $kategori_id);
        }

        $artikel = $builder->paginate(10, 'default', $page);
        $pager = $model->pager;

        $data = [
            'title' => $title,
            'q' => $q,
            'kategori_id' => $kategori_id,
            'artikel' => $artikel,
            'pager' => $pager
        ];

        // Jika request berasal dari AJAX, kembalikan format JSON
        if ($this->request->isAJAX()) {
            sleep(3);
            return $this->response->setJSON($data);
        } else {
            // Jika request biasa, tampilkan view HTML
            $kategoriModel = new \App\Models\KategoriModel();
            $data['kategori'] = $kategoriModel->findAll();
            return view('artikel/admin_index', $data);
        }
    }

    public function add()
    {
        $model = new ArtikelModel();

        if (strtolower($this->request->getMethod()) === 'post') {
            
            if ($this->validate([
                'judul' => 'required',
                'id_kategori' => 'required' 
            ])) {
                
                // --- PENAMBAHAN DARI MODUL 7: PROSES UPLOAD GAMBAR ---
                $file = $this->request->getFile('gambar'); // Mengambil file gambar [cite: 549]
                $nama_gambar = ''; 

                // Cek apakah file ada dan valid
                if ($file && $file->isValid() && ! $file->hasMoved()) {
                    // Pindahkan ke folder public/gambar [cite: 550]
                    $file->move(ROOTPATH . 'public/gambar');
                    // Ambil nama file untuk disimpan ke database [cite: 560]
                    $nama_gambar = $file->getName();
                }
                // -----------------------------------------------------

                $model->insert([
                    'judul' => $this->request->getPost('judul'),
                    'isi' => $this->request->getPost('isi'),
                    'slug' => url_title($this->request->getPost('judul'), '-', true),
                    'id_kategori' => $this->request->getPost('id_kategori'),
                    'gambar' => $nama_gambar // Menyimpan nama gambar ke tabel
                ]);
                return redirect()->to('/admin/artikel'); // [cite: 561]
            } else {
                dd($this->validator->getErrors());
            }
        }

        $kategoriModel = new KategoriModel();
        $data['kategori'] = $kategoriModel->findAll(); 
        $data['title'] = "Tambah Artikel";
        return view('artikel/form_add', $data);
    }

    public function edit($id)
    {
        $model = new ArtikelModel();

        if (strtolower($this->request->getMethod()) === 'post') {
            
            if ($this->validate([
                'judul' => 'required',
                'id_kategori' => 'required'
            ])) {
                
                // --- LOGIKA UPDATE GAMBAR ---
                // 1. Ambil data artikel lama dulu untuk cek nama gambar yang lama
                $artikelLama = $model->find($id);
                $nama_gambar = $artikelLama['gambar']; // Default pakai gambar lama

                // 2. Cek apakah ada file gambar baru yang di-upload
                $file = $this->request->getFile('gambar');
                if ($file && $file->isValid() && ! $file->hasMoved()) {
                    // Pindahkan gambar baru
                    $file->move(ROOTPATH . 'public/gambar');
                    // Ganti nama_gambar dengan file yang baru
                    $nama_gambar = $file->getName(); 
                }
                // -----------------------------

                $model->update($id, [
                    'judul' => $this->request->getPost('judul'),
                    'isi' => $this->request->getPost('isi'),
                    'id_kategori' => $this->request->getPost('id_kategori'),
                    'gambar' => $nama_gambar // Simpan nama gambar (baru atau lama)
                ]);
                return redirect()->to('/admin/artikel');
            } else {
                dd($this->validator->getErrors());
            }
        }

        $data['artikel'] = $model->find($id);
        $kategoriModel = new \App\Models\KategoriModel();
        $data['kategori'] = $kategoriModel->findAll(); 
        $data['title'] = "Edit Artikel";
        return view('artikel/form_edit', $data);
    }

    public function delete($id)
    {
        $model = new ArtikelModel();
        $model->delete($id);
        return redirect()->to('/admin/artikel');
    }

    public function view($slug)
    {
        $model = new ArtikelModel();
        $data['artikel'] = $model->select('artikel.*, kategori.nama_kategori')
            ->join('kategori', 'kategori.id_kategori = artikel.id_kategori')
            ->where('slug', $slug)
            ->first();

        if (empty($data['artikel'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the article.');
        }
        $data['title'] = $data['artikel']['judul'];
        return view('artikel/detail', $data);
    }

    public function kategori($id_kategori)
    {
        $model = new ArtikelModel();
        $kategoriModel = new KategoriModel();
        
        $kategori = $kategoriModel->find($id_kategori);
        if (!$kategori) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data['title'] = "Kategori: " . $kategori['nama_kategori'];
        
        $data['artikel'] = $model->select('artikel.*, kategori.nama_kategori')
                                 ->join('kategori', 'kategori.id_kategori = artikel.id_kategori')
                                 ->where('artikel.id_kategori', $id_kategori)
                                 ->findAll();

        return view('artikel/index', $data); 
    }
}