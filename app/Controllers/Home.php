<?php

namespace App\Controllers;
use App\Models\CustomersModel;
use App\Models\DriversModel;
use App\Models\MenusModel;
use App\Models\RestaurantsModel;
use App\Models\OrdersModel;
use App\Models\OrdersDetailModel;

class Home extends BaseController
{
    protected $customersModel;
    protected $driversModel;
    protected $menusModel;
    protected $restaurantsModel;
    protected $orderModel;
    protected $ordersDetailModel;

    public function __construct()
    {
        $this->customersModel   = new CustomersModel();
        $this->driversModel     = new DriversModel();
        $this->menusModel       = new MenusModel();
        $this->restaurantsModel = new RestaurantsModel();
        $this->orderModel       = new OrdersModel();
        $this->ordersDetailModel= new OrdersDetailModel();
    }
     public function index() : string
    {
        $orders = $this->orderModel->getOrderDay();

    $chartLabel = [];
    $chartData  = [];

    foreach ($orders as $row) {
        $chartLabel[] = date('d M', strtotime($row['hari'])); // contoh: 28 Jan
        $chartData[]  = (int) $row['total'];
    }

        
        $data = [
            'title'            => 'Dashboard',
            'totalCustomers'   => $this->customersModel->countAll(),
            'totalDrivers'     => $this->driversModel->countAll(),
            'totalMenus'       => $this->menusModel->countAll(),
            'totalRestaurants' => $this->restaurantsModel->countAll(),
            'totalOrders'      => $this->orderModel->countAll(),
            'totalTerjual'     => $this->orderModel->where('status','selesai')->countAllResults(),
            'totalDibatalkan'  => $this->orderModel->where('status','Dibatalkan')->countAllResults(),
            'totalOrdersSelesai' => $this->orderModel->where('status','selesai')->countAllResults(),
            'totalOrdersDibatalkan' => $this->orderModel->where('status','Dibatalkan')->countAllResults(),
            'totalOrdersDiproses' => $this->orderModel->where('status','Diproses')->countAllResults(),
            'totalOrdersDikirim' => $this->orderModel->where('status','Dikirim')->countAllResults(),
            'chartLabel' => $chartLabel,
            'chartData' => $chartData
        ];

        return view('dashboard', $data);
    }
}
