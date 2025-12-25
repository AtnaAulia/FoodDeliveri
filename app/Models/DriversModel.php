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
}
