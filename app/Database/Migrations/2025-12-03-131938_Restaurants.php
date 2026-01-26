<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Restaurants extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'restaurants_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true
            ],
            'address' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'opening_hours' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
<<<<<<< HEAD
                'default' => 'Open',
=======
>>>>>>> 7a12b2b1a9f87a7f705c6fc500552e680ff465b3
                'null' => true
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            ]);
            $this->forge->addKey('restaurants_id', true);
            $this->forge->createTable('restaurants');
    }

    public function down()
    {
        $this->forge->dropTable('restaurants');
    }
}
