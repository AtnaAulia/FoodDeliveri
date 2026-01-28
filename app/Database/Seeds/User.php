<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    public function run()
    {
         $data = [
            [
                'nama' => 'Admin',
                'username' => 'admin',
                'password' => password_hash('123456',PASSWORD_DEFAULT),
                'role' => 'Admin',
            ],
            [
                'nama' => 'Owner',
                'username' => 'owner',
                'password' => password_hash('123456',PASSWORD_DEFAULT),
                'role' => 'Owner',
            ],
        ];
        $this->db->table('user')->insertBatch($data);
    }
}
