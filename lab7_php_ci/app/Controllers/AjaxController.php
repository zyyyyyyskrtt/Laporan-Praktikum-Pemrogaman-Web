<?php
namespace App\Controllers;
use App\Models\ArtikelModel;

class AjaxController extends BaseController
{
    public function index()
    {
        $data['title'] = "Daftar Artikel (AJAX)";
        // Kita panggil view ajax/index
        return view('ajax/index', $data);
    }

    // Fungsi untuk mengambil data artikel sebagai JSON
    public function getData()
    {
        $model = new ArtikelModel();
        $data = $model->findAll();
        
        return $this->response->setJSON($data);
    }

    // Fungsi untuk menghapus data artikel via AJAX
    public function delete($id)
    {
        $model = new ArtikelModel();
        $model->delete($id);
        
        return $this->response->setJSON(['status' => 'OK']);
    }
}