<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DriversModel;
use App\Models\OrdersModel;
use App\Models\MenusModel;
use App\Models\OrdersDetailModel;
use App\Models\RestaurantsModel;

class LaporanController extends BaseController
{

    protected $menusModel;
    protected $driversModel;
    protected $ordersModel;
    protected $orderDetailsModel;
    protected $restaurantsModel;
    public function __construct()
    {
        $this->ordersModel = new OrdersModel();
        $this->orderDetailsModel = new OrdersDetailModel();
        $this->menusModel = new MenusModel();
        $this->driversModel = new DriversModel();
        $this->restaurantsModel = new RestaurantsModel();
    }
    public function index()
    {
        //
    }

    public function orders()
    {
        $periode = $this->request->getGet('periode');
        

        $tanggal_mulai = date('Y-m-01', strtotime($periode));//awal bulan saat ini
        $tanggal_selesai = date('Y-m-d',strtotime($periode));

        $laporan = $this->ordersModel->laporanOrders($tanggal_mulai,$tanggal_selesai);

        $data = [
            'title' => 'Laporan',
            'subtitle' => 'Laporan Peminjaman',
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
            'laporan' => $laporan,
            'order_time' => date('Y-m-d')
        ];
        return view('laporan/orders',$data);
    }
    public function pendapatan()
    {
        $periode = $this->request->getGet('periode');
        

        $tanggal_mulai = date('Y-m-01', strtotime($periode));//awal bulan saat ini
        $tanggal_selesai = date('Y-m-d',strtotime($periode));

        $laporan = $this->ordersModel->laporanPendapatan();

        $data = [
            'title' => 'Laporan',
            'subtitle' => 'Laporan Peminjaman',
            'laporan' => $laporan,
            'order_time' => date('M Y')
        ];
        return view('laporan/pendapatan',$data);
    }
    public function driver()
    {
        $periode = $this->request->getGet('periode');
        

        $tanggal_mulai = date('Y-m-01', strtotime($periode));//awal bulan saat ini
        $tanggal_selesai = date('Y-m-d',strtotime($periode));

        $laporan = $this->ordersModel->laporanDriver();

        $data = [
            'title' => 'Laporan',
            'subtitle' => 'Laporan Peminjaman',
            'laporan' => $laporan,
            'order_time' => date('M Y')
        ];
        return view('laporan/driver',$data);
    }
    public function restaurants()
    {
        $periode = $this->request->getGet('periode');
        

        $tanggal_mulai = date('Y-m-01', strtotime($periode));//awal bulan saat ini
        $tanggal_selesai = date('Y-m-d',strtotime($periode));

        $laporan = $this->ordersModel->laporanRestoran();
        foreach($laporan as &$row){
            $row['menu_terlaris'] = $this->orderDetailsModel->menuLaris($row['restaurants_id']);
        }

        $data = [
            'title' => 'Laporan',
            'subtitle' => 'Laporan Peminjaman',
            'laporan' => $laporan,
            'order_time' => date('M Y')
        ];
        return view('laporan/restoran',$data);
    }
}
