<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

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
     
    public function __construct()
    {
       $this->customersModel = new CustomersModel();
       $this->driversModel = new DriversModel();
       $this->menusModel = new MenusModel();
       $this->restaurantsModel = new RestaurantsModel();
       $this->orderModel = new OrdersModel();
       $this->ordersDetailModel = new OrdersDetailModel();
    }
    

    public function index()
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
    public function create(){
         $restaurant_id = $this->request->getGet('restaurants_id');

        $menus = $restaurant_id
        ? $this->menusModel->where('restaurants_id', $restaurant_id)->findAll()
        : [];
       
        $data =[
            'titlle' => 'Order',
            'subtitle' => 'Tambah Orderan',
            'customers' => $this->customersModel->findAll(),
            'restaurants' => $this->restaurantsModel->findAll(),
            'drivers' => $this->driversModel->where('status', 'Online')->findAll(),
            'menus' => $menus,
            'selectedRestaurant' => $restaurant_id
        ];
        
        return view('orders/create',$data);
    }

    public function insert()
{
    $db = \Config\Database::connect();

    try {
        $driver_id = $this->request->getPost('driver_id');
        $listMenu  = $this->request->getPost('menus_id');
        $qty       = $this->request->getPost('qty');
        $price     = $this->request->getPost('price');
        $subtotal  = $this->request->getPost('subtotal') ?? [];

        $totalAmount = array_sum($subtotal);

        $db->transBegin();

        $orders_id = $this->orderModel->insert([
            'order_number'     => $this->orderModel->OrderNumber(),
            'customers_id'     => $this->request->getPost('customers_id'),
            'restaurants_id'   => $this->request->getPost('restaurants_id'),
            'driver_id'        => $driver_id,
            'order_time'       => $this->request->getPost('order_time'),
            'delivery_address' => $this->request->getPost('delivery_address'),
            'status'           => 'Diproses',
            'total_amount'     => $totalAmount,
        ], true);


        if (!empty($listMenu)) {
            foreach ($listMenu as $m => $menu_id) {
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

        if ($db->transStatus() === false) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Gagal membuat pesanan');
        } else {
            $db->transCommit();
            return redirect()->to('/orders')->with('success', 'Pesanan Berhasil dibuat');
        }
    } catch (\Throwable $e) {
        $db->transRollback();
        throw $e;
    }
}
    public function DaftarMenu($restaurant_id){
        $menu = $this->menusModel->where('restaurants_id',$restaurant_id)->findAll();
        return $this->response->setJSON($menu);
    }

    public function Detail($id){
        $header = $this->orderModel->getHeaderById($id);
        $detail = $this->ordersDetailModel->getDetailById($id);

        $data = [
            'title' => 'Pemesanan',
            'subtitle' => 'Detail Pemesanan',
            'header' => $header,
            'detail' => $detail
        ];
        return view('orders/detail',$data);

    }
    public function kirim($id){
        $order = $this->orderModel->find($id);
        $driver_id = $order['driver_id'];
        
        $this->orderModel->update($id,[
            'status'=>'Dikirim',
        ]);
         $this->driversModel->setOffline($driver_id);
        return redirect()->to('/orders')->with('success','Pesanan Sedang diantar');
    }
    public function Selesai($id){
        $order = $this->orderModel->find($id);
        $driver_id= $order['driver_id'];
        $this->orderModel->update($id,[
            'status' => 'Selesai',
        ]);
        $this->driversModel->setOnline($driver_id);
        return redirect()->to('/orders')->with('success','Pesanan telah Selesai');
    }
}
