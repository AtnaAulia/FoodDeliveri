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
    
}
