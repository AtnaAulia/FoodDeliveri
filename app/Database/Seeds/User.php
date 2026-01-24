<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    public function run()
    {
         $data = [
            [
                'nama' => 'Staf Perpustakaan',
                'username' => 'staff',
                'password' => password_hash('123456',PASSWORD_DEFAULT),
                'role' => 'staf',
            ],
            [
                'nama' => 'Kepala Perpustakaan',
                'username' => 'kepala',
                'password' => password_hash('123456',PASSWORD_DEFAULT),
                'role' => 'kepala',
            ],
        ];
        $this->db->table('user')->insertBatch($data);
    }
}
