<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomersModel;
use App\Models\DriversModel;
use App\Models\MenusModel;
use App\Models\RestaurantsModel;
use App\Models\OrdersModel;
use App\Models\OrdersDetailModel;

class DashboardController extends BaseController
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

    public function index()
    {
        $data = [
            'title'            => 'Dashboard',
            'totalCustomers'   => $this->customersModel->countAll(),
            'totalDrivers'     => $this->driversModel->countAll(),
            'totalMenus'       => $this->menusModel->countAll(),
            'totalRestaurants' => $this->restaurantsModel->countAll(),
            'totalOrders'      => $this->orderModel->countAll(),
        ];

        return view('dashboard', $data);
    }
}
