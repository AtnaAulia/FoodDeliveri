<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Customers extends Seeder
{
    public function run()
    {
        $data=[
            ['name' => 'Jokowiroto',
            'phone' => '0812345',
            'email' => 'joko@delevery.com',
            'address' => 'Jl. Melati No. 12, Gang Kenangan, Kota Bahagia',
            ],
            ['name' => 'Bahlulul',
            'phone' => '0856789',
            'email' => 'bahbeng@delevery.com',
            'address' => 'Jl. Mawar Merah No. 7, Perumahan Ceria Indah, Desa Harapan',
            ],
            ['name' => 'Cupri',
            'phone' => '0783245',
            'email' => 'cupri@delevery.com',
            'address' => 'Jl. Kenanga Blok C-21, Komplek Pelangi Asri, Kecamatan Damai',
            ],
        ];
        $this->db->table('customers')->insertBatch($data);
    }
}
