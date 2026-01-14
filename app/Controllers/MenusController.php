<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\ResponseInterface;

class MenusController extends BaseController
{
    public function index() {
        $menusModel = new \App\Models\MenusModel();
        $keyword = $this->request->getGet('keyword');
        $data = [
          'title' => 'Menus',
          'subtitle' => 'Data Menus',
          'menus' => $menusModel->getMenus(5, 'menus', $keyword),
          'pager' => $menusModel->pager,
          'perPage' => 5,
          'keyword' => $keyword
        ];
        return view('menus/index', $data);
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

        // ambil file gambar dari form
        $coverFile = $this->request->getFile('cover');
        $coverName = null; //default jika tidak ada cover yang tidak diupload

        if ($coverFile && $coverFile->isValid() && !$coverFile->hasMoved()) 
        {
            //nama file random agar tidak terjadi duplikasi
            $coverName = $coverFile->getRandomName();

            //simpan file upload ke folder public/image/cover
            $coverFile->move(FCPATH. 'image/cover', $coverName);
        }

        $menusModel->save([
            'restaurants_id' => $this->request->getPost('restaurants_id'),
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'is_available' => 'Yes',
            'cover' => $coverName
        ]);
        //Mengembalikan ke index buku dengan flash massage "success" pada main.php
       return redirect()->to('/menus')->with('toast', [
            'type' => 'success',
            'title' => 'Berhasil',
            'message' => 'Data customer berhasil ditambahkan'
        ]);
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

        return redirect()->to('/menus')->with('toast', [
            'type' => 'success',
            'title' => 'Berhasil',
            'message' => 'Data customer berhasil diperbarui'
        ]);
    } //Fungsi Update Data Buku Berdasarkan ID Dengan Menggunakan Function
    
//perbaikan delete
    public function delete($id)
    {
        $menusModels = new \App\Models\MenusModel();
        $menu = $menusModels->find($id);
        if(!$menu){
            throw PageNotFoundException::forPageNotFound("Data tidak ditemukan");
        }
        $menusModels->delete($id);
        return redirect()->to('/menus')->with('toast', [
            'type' => 'delete',
            'title' => 'Dihapus',
            'message' => 'Data customer berhasil dihapus'
        ]);
    }
}
