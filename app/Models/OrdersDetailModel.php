<?php

namespace App\Models;

use CodeIgniter\Model;

class OrdersDetailModel extends Model
{
    protected $table            = 'order_details';
    protected $primaryKey       = 'order_detail_id';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'orders_id',
        'menus_id',
        'qty',
        'price',
        'subtotal',
    ];
    public function getDetailById($id){
        return $this->select('order_details.*,menus.name')
                    ->join('menus','menus.menus_id = order_details.menus_id','left')
                    ->where('orders_id',$id)
                    ->findAll();
    }
    public function menuLaris($restaurants_id)
{
    return $this->select('menus.name AS nama_menu, SUM(order_details.qty) AS total_terjual')
                ->join('menus','menus.menus_id = order_details.menus_id')
                ->join('orders','orders.orders_id = order_details.orders_id')
                ->where('orders.restaurants_id', $restaurants_id)
                ->where('orders.status', 'Selesai')
                ->groupBy('menus.menus_id, menus.name')
                ->orderBy('total_terjual', 'DESC')
                ->limit(1)
                ->get()
                ->getRow();
}

    
}
