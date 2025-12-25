<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class MenusController extends BaseController
{
    public function index()
    {
        //Menampilkan Seluruh Data Menus Dengan Join Table Dari Model
        $menusModel = new \App\Models\MenusModel(); //menghubungkan file model ke controller
        $data['menus'] = $menusModel->getMenus(); //Join Table dari Model
        return view('menus/index', $data); //Mengirimkan data ke folder menus/index.php
    }

    public function create()
    {
        $restaurantsModel = new \App\Models\RestaurantsModel(); //menghubungkan file model ke controller
        $data = [
            'title' => 'menus',
            'subtitle' => 'Tambah Data Menus',
            'restaurants' => $restaurantsModel->findAll()
        ];

        return view('menus/create', $data);
    }

    public function insert()
    {
        $menusModel = new \App\Models\MenusModel();
        // di bawah ini adalah query INSERT INTO versi codeigniter
        $menusModel->insert([
            'restaurants_id' => $this->request->getPost('restaurants_id'),
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price')
        ]);
        //Mengembalikan ke index buku dengan flash massage "success" pada main.php
        return redirect()->to('/menus')->with('success', 'Data Buku Berhasil Disimpan');
    }

    public function edit($id)
    {
        $menusModel = new \App\Models\MenusModel();

        $data = [
            'title' => 'menus',
            'subtitle' => 'Ubah Data Menus',
            'menus' => $menusModel->find($id)
        ];
        return view('menus/edit', $data); //Mengirimkan data ke folder buku/edit.php
    }

    public function update($id) {
        $bukuModel = new \App\Models\BukuModel();

        $bukuModel->update($id, [
            'judul' => $this->request->getPost('judul'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'pengarang' => $this->request->getPost('pengarang'),
            'tahun_terbit' => $this->request->getPost('tahun_terbit')
        ]);

        return redirect()->to('/buku')->with('success', 'Data Buku Berhasil Update');
    } //Fungsi Update Data Buku Berdasarkan ID Dengan Menggunakan Function

    public function delete($id)
    {
        $bukuModel = new \App\Models\BukuModel();

        $buku = $bukuModel->find($id);
        if (!$buku) {
            throw PageNotFoundException::forPageNotFound('Data Buku Tidak Ditemukan');
        }

        $bukuModel->delete($id);
        return redirect()->to('/buku')->with('success', 'Data Buku Berhasil Dihapus');
    }
}
