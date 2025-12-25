<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DriversController extends BaseController
{
    public function index()
    {
        $driversModel = new \App\Models\DriversModel();
        $drivers = $driversModel->findAll();
        return view('drivers/index', ['drivers' => $drivers]);
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
        $driversModel = new \App\Models\DriversModel();
        // di bawah ini adalah query INSERT INTO versi codeigniter
        $driversModel->insert([
            'name' => $this->request->getPost('name'),
            'phone' => $this->request->getPost('phone'),
            'vehicle_plate' => $this->request->getPost('vehicle_plate'),
            
        ]);
        //Mengembalikan ke index buku dengan flash massage "success" pada main.php
        return redirect()->to('/drivers')->with('success', 'Data Kategori Berhasil Disimpan');
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
        $driversModel = new \App\Models\DriversModel();
        $driversModel->update($id, [
            'name' => $this->request->getPost('name'),
            'phone' => $this->request->getPost('phone'),
            'vehicle_plate' => $this->request->getPost('vehicle_plate'),
        ]);
        return redirect()->to('/drivers')->with('success', 'Data Drivers Berhasil Diubah');
    }

    public function delete($id)
    {
        $driversModel = new \App\Models\DriversModel();
        $driversModel->delete($id);
        return redirect()->to('/drivers')->with('success', 'Data Drivers Berhasil Dihapus');
    }
}
