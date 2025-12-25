<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Menus extends Seeder
{
    public function run()
    {
        $data=[
            ['restaurants_id' => '1',
            'name' => 'Nasi Goreng',
            'description' => 'Nasi Goreng dengan sayur',
            'price' => '20000'
            ],
            ['restaurants_id' => '2',
            'name' => 'Mie Goreng',
            'description' => 'Mie Goreng dengan sayur dan wahyu',
            'price' => '20000000'
            ],
            ['restaurants_id' => '3',
            'name' => 'Mie Ayam',
            'description' => 'Mie Ayam dengan 5 ayam kalkun khas arabia',
            'price' => '15000000'
            ],
        ];
        $this->db->table('menus')->insertBatch($data);
    }
}
