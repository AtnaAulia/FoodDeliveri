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

   public function edit($id){
    $menusModel = new \App\Models\MenusModel();
    $restaurantsModel = new \App\Models\RestaurantsModel();
    $data = [
        'title' => 'Update Menus',
        'subtitle' => 'Edit Data Menus',
        'menu' => $menusModel->find($id),
        'restaurants' => $restaurantsModel->findAll()
    ];

    return view('menus/edit', $data);
    }

   public function update($id){
        $menusModel = new \App\Models\MenusModel();
        $coverLama = $this->request->getPost('cover_lama');
        $coverFile = $this->request->getFile('cover');
        $coverName = $coverLama;
        if($coverFile && $coverFile->isValid() && !$coverFile->hasMoved()) {
            $newName = $coverFile->getRandomName();
            $coverFile->move('image/cover', $newName);
                if(!empty($coverLama) && file_exists(FCPATH.'image/cover/'.$coverLama)) {
                    unlink(FCPATH.'image/cover/'.$coverLama);
                }
            $coverName = $newName;
        }

        $menusModel->update($id, [
            'restaurants_id' => $this->request->getPost('restaurants_id'),
            'name' => $this->request->getPost('name'),
            'cover' => $coverName,
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'is_available' => $this->request->getPost('is_available')
        ]);

        return redirect()->to('menus')->with('success', 'Data Menus Berhasil Diubah');
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
