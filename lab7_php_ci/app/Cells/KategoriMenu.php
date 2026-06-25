<?php
namespace App\Cells;

class KategoriMenu
{
    public function render()
    {
        $kategoriModel = new \App\Models\KategoriModel();
        $data['kategori'] = $kategoriModel->findAll();

        // Kita akan buat tampilan menunya di folder components
        return view('components/kategori_menu', $data);
    }
}