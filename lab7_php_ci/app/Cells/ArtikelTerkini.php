<?php
namespace App\Cells;
use App\Models\ArtikelModel;

class ArtikelTerkini
{
    public function render()
    {
        $model = new ArtikelModel();
        
        // Menambahkan filter WHERE kategori = 'Berita'
        $artikel = $model->where('kategori', 'Berita')
                         ->orderBy('created_at', 'DESC')
                         ->findAll(5);
                         
        return view('components/artikel_terkini', ['artikel' => $artikel]);
    }
}