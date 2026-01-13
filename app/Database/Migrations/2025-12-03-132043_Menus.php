<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Menus extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'menus_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'restaurants_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true
            ],
            'cover' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => true
            ],

            'description' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'price' => [
                'type' => 'DECIMAL',
                'null' => true,
                'unsigned' => true
            ],
            'is_available' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
        ]);

        $this->forge->addKey('menus_id', true);
        $this->forge->addForeignKey('restaurants_id', 'restaurants', 'restaurants_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('menus');
    }

    public function down()
    {
        $this->forge->dropTable('menus');
    }
}
