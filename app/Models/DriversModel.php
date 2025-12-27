<?php

namespace App\Models;

use CodeIgniter\Model;

class DriversModel extends Model
{
    protected $table            = 'drivers';
    protected $primaryKey       = 'driver_id';
    protected $useAutoIncrement = true;
    // protected $returnType    = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'phone',
        'vehicle_plate',
        'status',
        
    ];

    // Dates
    protected $useTimestamps = true;
    public function getDrivers($perPage, $group, $keyword = null) {
        $builder = $this->select('drivers.*');

        if(!empty($keyword)) {
            $builder = $builder->groupStart()
            ->like('name', $keyword)
            ->orLike('phone', $keyword)
            ->orLike('vehicle_plate', $keyword)
            ->orLike('status', $keyword)
            ->groupEnd();
        }
        return $builder->paginate($perPage, $group);
    }
}
