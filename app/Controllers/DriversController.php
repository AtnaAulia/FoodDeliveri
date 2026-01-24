<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\ResponseInterface;

class DriversController extends BaseController
{
    public function index() {
        $driversModel = new \App\Models\DriversModel();
        $keyword = $this->request->getGet('keyword');
        $data = [
            'title' => 'Drivers',
            'subtitle' => 'Data Drivers',
            'drivers' => $driversModel->getDrivers(5, 'drivers', $keyword),
            'pager' => $driversModel->pager,
            'perPage' => 5,
            'keyword' => $keyword
        ];
        return view('drivers/index', $data);
    }

    public function create()
    {
        $driversModel = new \App\Models\DriversModel(); //menghubungkan file model ke controller
        $data = [
            'title' => 'Drivers',
            'subtitle' => 'Tambah Data Drivers',
        ];

        return view('Drivers/create', $data);
    }

    public function insert()
    {
        $db = \Config\Database::connect();

        try{
            $driversModel = new \App\Models\DriversModel();
            $db->transBegin();
        // di bawah ini adalah query INSERT INTO versi codeigniter
        $driversModel->insert([
            'name' => $this->request->getPost('name'),
            'phone' => $this->request->getPost('phone'),
            'vehicle_plate' => $this->request->getPost('vehicle_plate'),
            'status' => 'Online'

            
        ],true);
         if ($db->transStatus() === false) { //Cek apakah semua proses sukses
            $db->transRollback();
            return redirect()->back()->with('error', 'Gagal Memasukan Data');
        } else { //Simpan permanen JIKA sukses
            $db->transCommit(); 
            return redirect()->to('/drivers')->with('toast', [
            'type' => 'success',
            'title' => 'Berhasil',
            'message' => 'Data Drivers berhasil ditambahkan'
        ]); }
        }
        catch (\Throwable $e) { //Batalkan SEMUA jika ada 1 yang error
            $db->transRollback();
            throw $e;
        }
        
        //Mengembalikan ke index buku dengan flash massage "success" pada main.php
        
    }

     public function edit($id)
    {
        $driversModel = new \App\Models\DriversModel();

        $driver = $driversModel->find($id);

        if (!$driver) {
            return redirect()->to('/drivers');
        }

        return view('drivers/edit', [
            'driver' => $driver,
            'title'    => 'Drivers',
            'subtitle' => 'Edit Data Drivers'
        ]);
    }


    public function update($id)
    {
         $db = \Config\Database::connect();

    try{
            $driversModel = new \App\Models\DriversModel();
            $db->transBegin();
        $driversModel->update($id, [
            'name' => $this->request->getPost('name'),
            'phone' => $this->request->getPost('phone'),
            'vehicle_plate' => $this->request->getPost('vehicle_plate'),
            'status' => $this->request->getPost('status'),
            
        ],true);
        if ($db->transStatus() === false) { //Cek apakah semua proses sukses
            $db->transRollback();
            return redirect()->back()->with('error', 'Gagal mengedit');
        } else { //Simpan permanen JIKA sukses
            $db->transCommit(); 
           return redirect()->to('/drivers')->with('toast', [
            'type' => 'success',
            'title' => 'Berhasil',
            'message' => 'Data Drivers berhasil diperbarui'
        ]); }
        }
        catch (\Throwable $e) { //Batalkan SEMUA jika ada 1 yang error
            $db->transRollback();
            throw $e;
        }
        
    }
//perbaikan delete
    public function delete($id)
    {
        $driversModel = new \App\Models\DriversModel();
        $driver = $driversModel->find($id);
        if (!$driver){
            throw PageNotFoundException::forPageNotFound("Data tidak ditemukan");
        }
        $driversModel->delete($id);
        return redirect()->to('/drivers')->with('toast', [
            'type' => 'delete',
            'title' => 'Dihapus',
            'message' => 'Data Driver berhasil dihapus'
        ]);
    }
}
