<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Restaurants extends Seeder
{
    public function run()
    {
        
        $data=[
            ['name' => 'Warung Selera Nusantara',
            'phone' => '08756423',
            'address' => 'Jl. Pemuda No. 1',
            'opening_hours' => '08:00',
            'status' => 'Beroperasi',
            ],
            ['name' => 'Dapur Rasa Makmur',
            'phone' => '08741234',
            'address' => 'Jl. Sumpah Pemuda No. 45',
            'opening_hours' => '09:00',
            'status' => 'Tutup'
            ],
            ['name' => 'Restoran Bintang Sejuta',
            'phone' => '08654123',
            'address' => 'Jl. Pemuda Jadi Sumpah No. 12',
            'opening_hours' => '10:00',
            'status' => 'Istirahat'
            ],
            
        ];
        $this->db->table('restaurants')->insertBatch($data);
    }
}
