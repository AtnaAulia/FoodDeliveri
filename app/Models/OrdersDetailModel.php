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
    
}
