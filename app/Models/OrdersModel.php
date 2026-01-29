<?php

namespace App\Models;

use CodeIgniter\Model;

class OrdersModel extends Model
{
    protected $table            = 'orders';
    protected $primaryKey       = 'orders_id';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'orders_id',
        'order_number',
        'customers_id',
        'restaurants_id',
        'driver_id',
        'order_time',
        'delivery_address',
        'status',
        'total_amount'
    ];

    

    // Dates
    protected $useTimestamps = true;

    public function getOrder($perpage,$group,$keyword = null){
        $builder = $this->select('orders.*,customers.name AS customers_name,restaurants.name AS restaurants_name,drivers.name AS drivers_name')
                    ->join('customers','customers.customers_id = orders.customers_id','left')
                    ->join('restaurants','restaurants.restaurants_id = orders.restaurants_id','left')
                    ->join('drivers','drivers.driver_id = orders.driver_id','left')
                    ->groupBy('orders_id');
                if($keyword){
                    $builder->groupStart()
                    ->like('customers.name',$keyword)
                    ->orLike('orders.status',$keyword)
                    ->groupEnd();
                }
                return $builder->paginate($perpage,$group);
    }
    public function OrderNumber(){
        return 'FD-'. rand(1000,9999). '-'. date('ymd');
    }
   public function getHeaderById($id){
    return $this->select('orders.*,customers.name AS customers_name,restaurants.name AS restaurants_name,drivers.name AS drivers_name')
                    ->join('customers','customers.customers_id = orders.customers_id','left')
                    ->join('restaurants','restaurants.restaurants_id = orders.restaurants_id','left')
                    ->join('drivers','drivers.driver_id = orders.driver_id','left')
                    ->where('orders_id',$id)
                    ->first();
   }

   public function laporanOrders($tanggalMulai,$tanggalSelesai){
     return $this->select('orders.*,customers.name AS customers_name,restaurants.name AS restaurants_name,drivers.name AS drivers_name')
                    ->join('customers','customers.customers_id = orders.customers_id','left')
                    ->join('restaurants','restaurants.restaurants_id = orders.restaurants_id','left')
                    ->join('drivers','drivers.driver_id = orders.driver_id','left')
                    ->where('order_time >=',$tanggalMulai)
                    ->where('order_time <=',$tanggalSelesai)
                    ->groupBy('orders_id')
                    ->orderBy('order_time','ASC')
                    ->findAll();
   }
  public function laporanPendapatan($tanggalMulai, $tanggalSelesai)
{
    return $this->select('
            restaurants.restaurants_id,
            restaurants.name AS restaurants_name,
            orders.order_time,
            COUNT(orders.orders_id) AS jumlah_order,
            SUM(orders.total_amount) AS total_pendapatan
        ') // Pastikan tidak ada koma setelah total_pendapatan sebelum tanda kutip tutup
        ->join('restaurants', 'restaurants.restaurants_id = orders.restaurants_id', 'left')
        ->where('orders.order_time >=', $tanggalMulai)
        ->where('orders.order_time <=', $tanggalSelesai)
        ->groupBy('restaurants.restaurants_id, restaurants.name, orders.order_time') 
        ->orderBy('restaurants.name', 'ASC')
        ->findAll();
}


  public function laporanDriver($tanggalMulai,$tanggalSelesai)
{
    return $this->select('drivers.name AS drivers_name,
                          COUNT(orders.orders_id) AS jumlah_antar,
                          drivers.status AS stat_drivers,
                          ')
                ->join('drivers', 'drivers.driver_id = orders.driver_id', 'left')
                ->where('orders.order_time >=',$tanggalMulai)
                ->where('orders.order_time <=',$tanggalSelesai)
                ->where('orders.status', 'Selesai')
                ->groupBy('drivers.driver_id')
                ->findAll();
}
public function laporanRestoran($tanggalMulai,$tanggalSelesai)
{
    return $this->select('restaurants.restaurants_id,
                          restaurants.name AS restaurants_name,
                          COUNT(DISTINCT menus.menus_id) AS jumlah_menu,
                          COUNT(DISTINCT orders.orders_id) AS jumlah_order,
                          SUM(orders.total_amount) AS total_pendapatan')
                ->join('restaurants', 'restaurants.restaurants_id = orders.restaurants_id', 'left')
                ->join('menus', 'menus.restaurants_id = restaurants.restaurants_id', 'left')
                ->where('orders.order_time >=',$tanggalMulai)
                ->where('orders.order_time <=',$tanggalSelesai)
                ->where('orders.status', 'Selesai')
                ->groupBy('restaurants.restaurants_id')
                ->get()
                ->getResultArray();
}

public function getOrderDay(){
    return $this->select('DATE(orders.order_time) AS hari, SUM(orders.total_amount) AS total')
                ->where('status','selesai')
                ->groupBy('DATE(orders.order_time)')
                ->orderBy('hari','ASC')
                ->findAll();

}

    
}
