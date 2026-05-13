<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Point d'entrée principal pour les seeders CodeIgniter
     * 
     * Exécution:
     *   php spark db:seed              (tous les seeders)
     *   php spark db:seed SeedDataSeeder  (seul ce seeder)
     */
    public function run()
    {
        $this->call(SeedDataSeeder::class);
    }
}
