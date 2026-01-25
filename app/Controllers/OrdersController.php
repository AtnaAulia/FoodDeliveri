<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\Pdf;

use App\Models\CustomersModel;
use App\Models\RestaurantsModel;
use App\Models\MenusModel;
use App\Models\DriversModel;
use App\Models\OrdersDetailModel;
use App\Models\OrdersModel;
use PHPUnit\TextUI\Configuration\Configuration;

class OrdersController extends BaseController
{   
    protected  $customersModel;
    protected  $driversModel;
    protected  $menusModel;
    protected  $restaurantsModel;
    protected  $orderModel;
    protected  $ordersDetailModel;
     
    public function __construct() //menghubungkan model untuk dijalankan secara otomatis
    {
       $this->customersModel = new CustomersModel();
       $this->driversModel = new DriversModel();
       $this->menusModel = new MenusModel();
       $this->restaurantsModel = new RestaurantsModel();
       $this->orderModel = new OrdersModel();
       $this->ordersDetailModel = new OrdersDetailModel();
    }
    
    public function index() //menampilkan data
    {
        $perpage = 5;
        $keyword = $this->request->getGet('keyword');
        $data = [
            'title' => 'Order',
            'subtitle' => 'Data Order',
            'orders' => $this->orderModel->getOrder($perpage,'orders',$keyword),
            'pager' => $this->orderModel->pager,
            'perpage' => $perpage,
            'keyword' => $keyword,
        ];
        return view('orders/index',$data);
    }
    public function create(){ //membuat struktur form
         $restaurants_id = $this->request->getGet('restaurants_id');

        $menus = [];
    if ($restaurants_id) {
        $menus = $this->menusModel
            ->where('restaurants_id', $restaurants_id)
            ->where('is_available', 'Yes')
            ->findAll();
    }
        $data =[
            'titlle' => 'Order',
            'subtitle' => 'Tambah Orderan',
            'customers' => $this->customersModel->findAll(),
            'restaurants' => $this->restaurantsModel->where('status','Open')->findAll(),
            'drivers' => $this->driversModel->where('status', 'Online')->findAll(),
            'menus' => $menus,
            'selectedRestaurant' => $restaurants_id
        ];
        
        return view('orders/create',$data);
    }

    public function insert() //menginput data   
    {
    $db = \Config\Database::connect();

    try {
        $driver_id = $this->request->getPost('driver_id'); //mengambil data dari form
        $listMenu  = $this->request->getPost('menus_id'); //mengambil data dari form
        $qty       = $this->request->getPost('qty'); //mengambil data dari form
        $price     = $this->request->getPost('price'); //mengambil data dari form
        $subtotal  = $this->request->getPost('subtotal') ?? []; //mengambil data dari form

        $totalAmount = array_sum($subtotal); //menghitung total harga

        $db->transBegin(); //untuk memulai transaksi dengan aman

        $orders_id = $this->orderModel->insert([ //Masukkan data ke tabel UTAMA
            'order_number'     => $this->orderModel->OrderNumber(),
            'customers_id'     => $this->request->getPost('customers_id'),
            'restaurants_id'   => $this->request->getPost('restaurants_id'),
            'driver_id'        => null,
            'order_time'       => date('Y-m-d H:i:s'),
            'delivery_address' => $this->request->getPost('delivery_address'),
            'status'           => 'Diproses',
            'total_amount'     => $totalAmount,
        ], true);


        if (!empty($listMenu)) { 
            foreach ($listMenu as $m => $menu_id) {//Masukkan data ke tabel DETAIL (looping tiap menu)
                if ($menu_id) {
                    $this->ordersDetailModel->insert([
                        'orders_id' => $orders_id,
                        'menus_id'  => $menu_id,
                        'qty'       => $qty[$m],
                        'price'     => $price[$m],
                        'subtotal'  => $subtotal[$m],
                    ]);
                }
            }
        }

        if ($db->transStatus() === false) { //Cek apakah semua proses sukses
            $db->transRollback();
            return redirect()->back()->with('error', 'Gagal membuat pesanan');
        } else { //Simpan permanen JIKA sukses
            $db->transCommit(); 
            return redirect()->to('/orders/detail/'.$orders_id)->with('success','Pesanan berhasil dibuat');
        }
        } catch (\Throwable $e) { //Batalkan SEMUA jika ada 1 yang error
            $db->transRollback();
            throw $e;
        }
    }
    public function DaftarMenu($restaurant_id) //menampilkan data menu berdasarkan tabel restaurant
    {
        $menu = $this->menusModel->where('restaurants_id',$restaurant_id)->where('is_available','Yes')->findAll();
        return $this->response->setJSON($menu);
    }

   public function Detail($id){ //menampilkan data detail
        $header = $this->orderModel->getHeaderById($id);
        $detail = $this->ordersDetailModel->getDetailById($id);

        $data = [
            'title'   => 'Pemesanan',
            'subtitle'=> 'Detail Pemesanan',
            'header'  => $header,
            'detail'  => $detail,
            'drivers' => $this->driversModel->where('status','Online')->findAll()
        ];

        return view('orders/detail',$data);
    }

    public function assignDriver($id) // memilih driver dan menugaskannya untuk mengantar makanan
    {
        $driver_id = $this->request->getPost('driver_id');

        if (!$driver_id) {
            return redirect()->back()->with('error', 'Driver wajib dipilih');
        }

        $this->orderModel->update($id, [
            'driver_id' => $driver_id,
            'status'    => 'Dikirim',
        ]);

        $this->driversModel->setOffline($driver_id);

        return redirect()->to('/orders')->with('success','Pesanan sedang diantar');
    }

    public function Selesai($id){ //pesanan selesai
        $order = $this->orderModel->find($id);
        $driver_id= $order['driver_id'];
        $this->orderModel->update($id,[
            'status' => 'Selesai',
        ]);
        $this->driversModel->setOnline($driver_id);
        return redirect()->to('/orders')->with('success','Pesanan telah Selesai');
    }
     public function cetak($id) {
        $header = $this->orderModel->getHeaderById($id);
        $detail = $this->ordersDetailModel->getDetailById($id);

        $data = [
            'header' => $header,
            'detail' => $detail,
        ];
        $html = view('orders/pdf',$data);

        $pdf = new Pdf();
        $pdf->generate($html,'Bukti Peminjaman - ' . $id);
    }
}
