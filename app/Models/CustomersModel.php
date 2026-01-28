<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomersModel extends Model
{
    protected $table            = 'customers';
    protected $primaryKey       = 'customers_id';
    protected $useAutoIncrement = true;
    // protected $returnType    = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'phone',
        'email',
        'address'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;
    
     public function getCustomers($perPage, $keyword = null) {
     $builder = $this->builder();

        if(!empty($keyword)) {
            $builder = $builder->groupStart()
            ->like('name', $keyword)
            ->orLike('phone', $keyword)
            ->orLike('email', $keyword)
            ->orLike('address', $keyword)
            ->groupEnd();
        }
        return $this->paginate($perPage);
    }
}
