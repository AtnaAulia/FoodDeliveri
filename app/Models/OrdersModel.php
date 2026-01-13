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
        return 'FD-'. rand(1000,9999). '-'. date('y-m-d');
    }
   public function getHeaderById($id){
    return $this->select('orders.*,customers.name AS customers_name,restaurants.name AS restaurants_name,drivers.name AS drivers_name')
                    ->join('customers','customers.customers_id = orders.customers_id','left')
                    ->join('restaurants','restaurants.restaurants_id = orders.restaurants_id','left')
                    ->join('drivers','drivers.driver_id = orders.driver_id','left')
                    ->where('orders_id',$id)
                    ->first();
   }
    
}
