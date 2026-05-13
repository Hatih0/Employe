<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEmployes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INTEGER',
                'auto_increment' => true,
            ],

            'nom' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            'prenom' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'unique'     => true,
            ],

            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            'role' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            'departement_id' => [
                'type' => 'INTEGER',
                'null' => true,
            ],

            'date_embauche' => [
                'type' => 'DATE',
                'null' => true,
            ],

            'actif' => [
                'type'       => 'VARCHAR',
                'constraint' => 1,
                'default'    => '1',
            ],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey(
            'departement_id',
            'departements',
            'id'
        );

        $this->forge->createTable('employes');
    }

    public function down()
    {
        $this->forge->dropTable('employes');
    }
}