<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OrderDetails extends Migration
{
    public function up()
{
    $this->forge->addField([
        'order_detail_id' => [
            'type' => 'INT',
            'unsigned' => true,
            'auto_increment' => true
        ],
        'orders_id' => [
            'type' => 'INT',
            'unsigned' => true
        ],
        'menus_id' => [
            'type' => 'INT',
            'unsigned' => true
        ],
        'qty' => [
            'type' => 'INT',
            'unsigned' => true
        ],
        'price' => [
            'type' => 'DECIMAL'
        ],
        'subtotal' => [
            'type' => 'DECIMAL'
        ],
        'created_at' => [
            'type' => 'DATETIME'
        ],
        'updated_at' => [
            'type' => 'DATETIME'
        ]
    ]);

    $this->forge->addKey('order_detail_id', true);
    $this->forge->addForeignKey('orders_id', 'orders', 'orders_id', 'CASCADE', 'CASCADE');
    $this->forge->addForeignKey('menus_id', 'menus', 'menus_id', 'CASCADE', 'CASCADE');

    $this->forge->createTable('order_details');
}

public function down()
{
    $this->forge->dropTable('order_details');
}
}
