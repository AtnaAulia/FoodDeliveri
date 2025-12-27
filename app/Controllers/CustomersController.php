<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\ResponseInterface;

class CustomersController extends BaseController
{
    public function index() {
        $customersModel = new \App\Models\CustomersModel();
        $keyword = $this->request->getGet('keyword');
        $data = [
            'title' => 'Customers',
            'subtitle' => 'Data Customers',
            'customers' => $customersModel->getCustomers(5, 'customers', $keyword),
            'pager' => $customersModel->pager,
            'perPage' => 5,
            'keyword' => $keyword
        ];
        return view('customers/index', $data);
    }

    public function create()
    {
        $customersModel = new \App\Models\CustomersModel(); //menghubungkan file model ke controller
        $data = [
            'title' => 'customers',
            'subtitle' => 'Tambah Data Customers',
        ];

        return view('customers/create', $data);
    }

    public function insert()
    {
        $customersModel = new \App\Models\CustomersModel();
        // di bawah ini adalah query INSERT INTO versi codeigniter
        $customersModel->insert([
            'name' => $this->request->getPost('name'),
            'phone' => $this->request->getPost('phone'),
            'email' => $this->request->getPost('email'),
            'address' => $this->request->getPost('address'),
        ]);
        //Mengembalikan ke index buku dengan flash massage "success" pada main.php
        return redirect()->to('/customers')->with('toast', [
            'type' => 'success',
            'title' => 'Berhasil',
            'message' => 'Data customer berhasil ditambahkan'
        ]);

    }
    

    public function edit($id)
    {
        $customersModel = new \App\Models\CustomersModel();

        $customer = $customersModel->find($id);

        if (!$customer) {
            return redirect()->to('/customers');
        }

        return view('customers/edit', [
            'customer' => $customer,
            'title'    => 'Customers',
            'subtitle' => 'Edit Data Customers'
        ]);
    }


    public function update($id){
    $customersModel = new \App\Models\CustomersModel();
    $customersModel->update($id, [
        'name'    => $this->request->getPost('name'),
        'phone'   => $this->request->getPost('phone'),
        'email'   => $this->request->getPost('email'),
        'address' => $this->request->getPost('address'),
    ]);

    return redirect()->to('/customers')->with('toast', [
    'type' => 'success',
    'title' => 'Berhasil',
    'message' => 'Data customer berhasil diperbarui'
    ]);

    }
//perbaikan delete
    public function delete($id) {
        $customersModel = new \App\Models\CustomersModel();
        $customer = $customersModel->find($id);
        if(!$customer){
            throw PageNotFoundException::forPageNotFound("Data Tidak ditemukan");
        }
        $customersModel->delete($id);
        return redirect()->to('/customers')->with('toast', [
            'type' => 'delete',
            'title' => 'Dihapus',
            'message' => 'Data customer berhasil dihapus'
        ]);

    }
}
