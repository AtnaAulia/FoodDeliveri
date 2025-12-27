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
        'is_available',
        'cover'
    ];

    // Dates
    protected $useTimestamps = true;

    public function getMenus($perPage, $group, $keyword = null){ 
        $builder = $this->select('menus.*, restaurants.name as restaurants_name')
        ->join('restaurants', 'restaurants.restaurants_id = menus.restaurants_id');

        if(!empty($keyword)) {
           $builder = $builder->groupStart()
           ->like('restaurants.name', $keyword)
           ->orLike('menus.name', $keyword)
           ->orLike('menus.description', $keyword)
           ->orLike('menus.price', $keyword)
           ->groupEnd();
        }   
        return $builder->paginate($perPage, $group);
    }
    
}
