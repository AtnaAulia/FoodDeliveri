<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\ResponseInterface;

class RestaurantsController extends BaseController
{
    public function index(){
        $restaurantsModel = new \App\Models\RestaurantsModel();
        $keyword = $this->request->getGet('keyword');
        $data = [
            'title' => 'Restaurants',
            'subtitle' => 'Data Restaurants',
            'restaurants' => $restaurantsModel->getRestaurants(5, 'restaurants', $keyword),
            'pager' => $restaurantsModel->pager,
            'perPage' => 5,
            'keyword' => $keyword
        ];
        return view('restaurants/index', $data);
    }

    public function create()
    {
        $restaurantsModel = new \App\Models\RestaurantsModel(); //menghubungkan file model ke controller
        $data = [
            'title' => 'restaurants',
            'subtitle' => 'Tambah Data Restaurants'
        ];

        return view('restaurants/create', $data);
    }

    public function insert()
    {
        $restaurantsModel = new \App\Models\RestaurantsModel();
        // di bawah ini adalah query INSERT INTO versi codeigniter
        $restaurantsModel->insert([
            'name' => $this->request->getPost('name'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
            'opening_hours' => $this->request->getPost('opening_hours'),
            
        ]);
        //Mengembalikan ke index buku dengan flash massage "success" pada main.php
        return redirect()->to('/restaurants')->with('toast', [
            'type' => 'success',
            'title' => 'Berhasil',
            'message' => 'Data Restaurants berhasil ditambahkan'
        ]);
    }

    public function edit($id)
    {
        $restaurantsModel = new \App\Models\RestaurantsModel();

        $restaurants = $restaurantsModel->find($id);

        if (!$restaurants) {
            return redirect()->to('/restaurants');
        }

        return view('restaurants/edit', [
            'restaurants' => $restaurants,
            'title' => 'restaurants',
            'subtitle' => 'Edit Data Restaurants'
        ]);
    }

    public function update($id)
    {
        $restaurantsModel = new \App\Models\RestaurantsModel();
        $restaurantsModel->update($id, [
            'name' => $this->request->getPost('name'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
            'opening_hours' => $this->request->getPost('opening_hours'),
            'status' => $this->request->getPost('status'),
        ]);
        return redirect()->to('/restaurants')->with('toast', [
            'type' => 'success',
            'title' => 'Berhasil',
            'message' => 'Data restaurants berhasil diperbarui'
        ]);
    }
//perbaikan delete
    public function delete($id)
    {
        $restaurantsModel = new \App\Models\RestaurantsModel();
        $restaurants = $restaurantsModel->find($id);
        if(!$restaurants){
            throw PageNotFoundException::forPageNotFound("Data tidak ditemukan");
        }
        $restaurantsModel->delete($id);
        return redirect()->to('/restaurants')->with('toast', [
            'type' => 'delete',
            'title' => 'Dihapus',
            'message' => 'Data restaurants berhasil dihapus'
        ]);
    }
}