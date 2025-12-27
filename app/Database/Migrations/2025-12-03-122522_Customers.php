<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Customers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'customers_id' => [
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
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'unique' => true,
                'null' => true
            ],
            'address' => [
                'type' => 'TEXT',
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
            $this->forge->addKey('customers_id', true);
            $this->forge->createTable('customers');
    }

    public function down()
    {
        $this->forge->dropTable('customers');
    }
}
