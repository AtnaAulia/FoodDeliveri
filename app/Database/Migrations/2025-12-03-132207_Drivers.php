<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Drivers extends Migration
{
    public function up()
{
    $this->forge->addField([
        'driver_id' => [
            'type' => 'INT',
            'unsigned' => true,
            'auto_increment' => true
        ],
        'name' => [
            'type' => 'VARCHAR',
            'constraint' => 150
        ],
        'phone' => [
            'type' => 'VARCHAR',
            'constraint' => 20,
            'null' => true
        ],
        'vehicle_plate' => [
            'type' => 'VARCHAR',
            'constraint' => 20,
            'unique' => true
        ],
        'status' => [
            'type' => 'VARCHAR',
            'constraint' => 50,
            'default' => 'Available',
            'null' => true
        ],
        'created_at' => [
            'type' => 'DATETIME',
            'null' => true
        ],
        'updated_at' => [
            'type' => 'DATETIME',
            'null' => true
        ]
    ]);
    $this->forge->addKey('driver_id', true);
    $this->forge->createTable('drivers');
}

public function down()
{
    $this->forge->dropTable('drivers');
}
}
