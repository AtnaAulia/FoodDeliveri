<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Drivers extends Seeder
{
    public function run()
    {
        $data=[
            ['name' => 'Budi',
            'phone' => '08756423',
            'vehicle_plate' => 'B 1234 ABC',
            'status' => 'available'
            ],
            ['name' => 'Santo',
            'phone' => '08745632',
            'vehicle_plate' => 'B 9874 ABC',
            'status' => 'offline'
            ],
            ['name' => 'Budiyono siregar',
            'phone' => '08987654',
            'vehicle_plate' => 'B 4567 ABC',
            'status' => 'busy'
            ],
        ];
    $this->db->table('drivers')->insertBatch($data);
    }
}
