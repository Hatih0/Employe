<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * ResetSeeder
 * 
 * Réinitialise la base de données en supprimant toutes les données
 * 
 * Exécution:
 *   php spark db:seed ResetSeeder
 */
class ResetSeeder extends Seeder
{
    public function run()
    {
        echo "\n════════════════════════════════════════════════════════════\n";
        echo "🔄 RESET - Réinitialisation de la base de données\n";
        echo "════════════════════════════════════════════════════════════\n\n";

        echo "1️⃣  Suppression des données existantes...\n";

        // Suppression dans l'ordre inverse des dépendances
        $tables = ['conges', 'soldes', 'employes', 'types_conge', 'departements'];
        
        foreach ($tables as $table) {
            $this->db->table($table)->truncate();
            echo "   ✅ Table '$table' vidée\n";
        }

        echo "\n════════════════════════════════════════════════════════════\n";
        echo "✅ RESET TERMINÉ AVEC SUCCÈS !\n";
        echo "════════════════════════════════════════════════════════════\n\n";

        echo "📝 PROCHAINES ÉTAPES:\n";
        echo "   $ php spark db:seed SeedDataSeeder\n\n";
    }
}
