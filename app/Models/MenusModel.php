<?php

namespace App\Models;

use CodeIgniter\Model;

class MenusModel extends Model
{
    protected $table            = 'menus';
    protected $primaryKey       = 'menus_id';
    protected $useAutoIncrement = true;
    // protected $returnType    = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'restaurants_id',
        'name',
        'description',
        'price',
        'is_available'
    ];

    // Dates
    protected $useTimestamps = true;

    public function getMenus()
    {
        return $this->select('menus.*, restaurants.name as restaurants_name')
        ->join('restaurants', 'restaurants.restaurants_id = menus.restaurants_id')
        ->findAll();
    }
    
}
