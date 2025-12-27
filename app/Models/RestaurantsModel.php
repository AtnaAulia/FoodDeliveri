<?php

namespace App\Models;

use CodeIgniter\Model;

class RestaurantsModel extends Model
{
    protected $table            = 'restaurants';
    protected $primaryKey       = 'restaurants_id';
    protected $useAutoIncrement = true;
    // protected $returnType    = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'phone',
        'address',
        'opening_hours',
        'status',
    ];

    // Dates
    protected $useTimestamps = true;
    public function getRestaurants($perPage, $group, $keyword = null){
        $builder = $this->select('restaurants.*');

        if(!empty($keyword)) {
            $builder = $builder->groupStart()
            ->like('name', $keyword)
            ->orLike('phone', $keyword)
            ->orLike('address', $keyword)
            ->orLike('opening_hours', $keyword)
            ->orLike('status', $keyword)
            ->groupEnd();
        }
        return $builder->paginate($perPage, $group);
    }
    
}
