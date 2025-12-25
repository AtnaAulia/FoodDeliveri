<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Orders extends Migration
{
    public function up()
{
    $this->forge->addField([
        'orders_id' => [
            'type' => 'INT',
            'unsigned' => true,
            'auto_increment' => true
        ],
        'order_number' => [
            'type' => 'INT',
            'null' => true,
            'unsigned' => true
        ],
        'customers_id' => [
            'type' => 'INT',
            'unsigned' => true
        ],
        'restaurants_id' => [
            'type' => 'INT',
            'unsigned' => true
        ],
        'driver_id' => [
            'type' => 'INT',
            'unsigned' => true,
            'null' => true
        ],
        'order_time' => [
            'type' => 'DATETIME'
        ],
        'delivery_address' => [
            'type' => 'TEXT',
            'null' => true
        ],
        'status' => [
            'type' => 'VARCHAR',
            'constraint' => 50,
            'default' => 'Pending',
            'null' => true
        ],
        'total_amount' => [
            'type' => 'DECIMAL'
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

    $this->forge->addKey('orders_id', true);
    $this->forge->addForeignKey('customers_id', 'customers', 'customers_id');
    $this->forge->addForeignKey('restaurants_id', 'restaurants', 'restaurants_id');
    $this->forge->addForeignKey('driver_id', 'drivers', 'driver_id');

    $this->forge->createTable('orders');
}

public function down()
{
    $this->forge->dropTable('orders');
}
}
