<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLibelleToTypesConge extends Migration
{
    public function up()
    {
        $this->forge->addColumn('types_conge', [
            'libelle' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('types_conge', 'libelle');
    }
}