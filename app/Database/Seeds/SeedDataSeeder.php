<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * SeedDataSeeder
 * 
 * Données de test pour le système de gestion des congés TechMada RH
 * Basé sur le template: template-conges-rh-ci4.html
 * 
 * Exécution:
 *   php spark db:seed SeedDataSeeder
 */
class SeedDataSeeder extends Seeder
{
    public function run()
    {
        echo "\n════════════════════════════════════════════════════════════\n";
        echo "📊 SEEDING - Système de Gestion des Congés TechMada RH\n";
        echo "════════════════════════════════════════════════════════════\n\n";

        // ===== 1. DEPARTEMENTS =====
        echo "1️⃣  Création des départements...\n";
        
        $departements = [
            ['nom' => 'Direction', 'description' => 'Direction générale'],
            ['nom' => 'Ressources Humaines', 'description' => 'Département RH'],
            ['nom' => 'Informatique', 'description' => 'Département IT'],
            ['nom' => 'Ventes', 'description' => 'Département commercial'],
            ['nom' => 'Marketing', 'description' => 'Département marketing'],
        ];
        
        foreach ($departements as $dept) {
            $this->db->table('departements')->insert($dept);
        }
        echo "   ✅ 5 départements ajoutés\n\n";

        // ===== 2. TYPES DE CONGES =====
        echo "2️⃣  Création des types de congés...\n";
        
        $typesConges = [
            ['jours_annuels' => 25, 'deductible' => '1'],  // Congé annuel
            ['jours_annuels' => 5,  'deductible' => '1'],  // Congé maladie
            ['jours_annuels' => 3,  'deductible' => '0'],  // Congé spécial
            ['jours_annuels' => 0,  'deductible' => '0'],  // Congé sans solde
        ];
        
        foreach ($typesConges as $type) {
            $this->db->table('types_conge')->insert($type);
        }
        echo "   ✅ 4 types de congés ajoutés\n";
        echo "      • Type 1: 25 jours annuels (déductible) - Congé annuel\n";
        echo "      • Type 2: 5 jours annuels (déductible) - Congé maladie\n";
        echo "      • Type 3: 3 jours annuels (non déductible) - Congé spécial\n";
        echo "      • Type 4: 0 jours (non déductible) - Congé sans solde\n\n";

        // ===== 3. EMPLOYES (3 ROLES) =====
        echo "3️⃣  Création des employés (3 rôles)...\n";
        
        $employes = [
            // ADMINISTRATEUR
            [
                'nom' => 'Admin',
                'prenom' => 'Système',
                'email' => 'admin@techmada.mg',
                'password' => password_hash('admin123', PASSWORD_BCRYPT),
                'role' => 'admin',
                'departement_id' => 1,
                'date_embauche' => '2020-01-01',
                'actif' => '1',
            ],
            // RESPONSABLE RH
            [
                'nom' => 'Randria',
                'prenom' => 'Marie',
                'email' => 'rh@techmada.mg',
                'password' => password_hash('rh123', PASSWORD_BCRYPT),
                'role' => 'rh',
                'departement_id' => 2,
                'date_embauche' => '2021-03-15',
                'actif' => '1',
            ],
            // EMPLOYES (6 employés pour tester)
            [
                'nom' => 'Rakoto',
                'prenom' => 'Jean',
                'email' => 'jean.rakoto@techmada.mg',
                'password' => password_hash('employe123', PASSWORD_BCRYPT),
                'role' => 'employe',
                'departement_id' => 3,
                'date_embauche' => '2022-05-20',
                'actif' => '1',
            ],
            [
                'nom' => 'Rabemananjara',
                'prenom' => 'Sophie',
                'email' => 'sophie.r@techmada.mg',
                'password' => password_hash('employe123', PASSWORD_BCRYPT),
                'role' => 'employe',
                'departement_id' => 3,
                'date_embauche' => '2021-08-10',
                'actif' => '1',
            ],
            [
                'nom' => 'Njara',
                'prenom' => 'Luc',
                'email' => 'luc.njara@techmada.mg',
                'password' => password_hash('employe123', PASSWORD_BCRYPT),
                'role' => 'employe',
                'departement_id' => 4,
                'date_embauche' => '2023-01-12',
                'actif' => '1',
            ],
            [
                'nom' => 'Nivelojoana',
                'prenom' => 'Andrianampoinimerina',
                'email' => 'andre.n@techmada.mg',
                'password' => password_hash('employe123', PASSWORD_BCRYPT),
                'role' => 'employe',
                'departement_id' => 4,
                'date_embauche' => '2022-11-05',
                'actif' => '1',
            ],
            [
                'nom' => 'Zafindrafita',
                'prenom' => 'Carla',
                'email' => 'carla.z@techmada.mg',
                'password' => password_hash('employe123', PASSWORD_BCRYPT),
                'role' => 'employe',
                'departement_id' => 5,
                'date_embauche' => '2023-02-28',
                'actif' => '1',
            ],
            [
                'nom' => 'Randrianampoinimerina',
                'prenom' => 'Fady',
                'email' => 'fady.r@techmada.mg',
                'password' => password_hash('employe123', PASSWORD_BCRYPT),
                'role' => 'employe',
                'departement_id' => 3,
                'date_embauche' => '2023-06-15',
                'actif' => '1',
            ],
        ];
        
        foreach ($employes as $emp) {
            $this->db->table('employes')->insert($emp);
        }
        echo "   ✅ 8 employés ajoutés (1 admin + 1 RH + 6 employés)\n\n";

        // ===== 4. SOLDES =====
        echo "4️⃣  Création des soldes pour 2026...\n";
        
        $annee = 2026;
        $typesCongesData = $this->db->table('types_conge')->get()->getResultArray();
        $typesMap = [];
        foreach ($typesCongesData as $type) {
            $typesMap[$type['id']] = $type['jours_annuels'];
        }
        
        // Créer les soldes pour chaque employé (sauf admin et RH pour simplifier)
        // ID des employés: 1=admin, 2=rh, 3-8=employes
        for ($emp_id = 3; $emp_id <= 8; $emp_id++) {
            for ($type_id = 1; $type_id <= 3; $type_id++) {
                $jours = $typesMap[$type_id] ?? 0;
                $this->db->table('soldes')->insert([
                    'employe_id' => $emp_id,
                    'type_conge_id' => $type_id,
                    'annee' => $annee,
                    'jours_attribues' => $jours,
                    'jours_pris' => 0,
                ]);
            }
        }
        echo "   ✅ Soldes créés (6 employés × 3 types = 18 soldes)\n\n";

        // ===== 5. DEMANDES DE CONGES =====
        echo "5️⃣  Création des demandes de congés...\n";
        
        $conges = [
            // EN ATTENTE
            [
                'employe_id' => 3,  // Jean Rakoto
                'type_conge_id' => 1,
                'date_debut' => '2026-05-25',
                'date_fin' => '2026-05-29',
                'nb_jours' => 5,
                'motif' => 'Vacances familiales',
                'statut' => 'en_attente',
                'commentaire_rh' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'traite_par' => null,
            ],
            [
                'employe_id' => 4,  // Sophie Rabemananjara
                'type_conge_id' => 1,
                'date_debut' => '2026-06-15',
                'date_fin' => '2026-06-19',
                'nb_jours' => 5,
                'motif' => 'Congé été',
                'statut' => 'en_attente',
                'commentaire_rh' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'traite_par' => null,
            ],
            [
                'employe_id' => 5,  // Luc Njara
                'type_conge_id' => 2,
                'date_debut' => '2026-05-20',
                'date_fin' => '2026-05-22',
                'nb_jours' => 3,
                'motif' => 'Maladie',
                'statut' => 'en_attente',
                'commentaire_rh' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'traite_par' => null,
            ],
            
            // APPROUVÉES
            [
                'employe_id' => 6,  // Andrianampoinimerina
                'type_conge_id' => 1,
                'date_debut' => '2026-04-20',
                'date_fin' => '2026-04-24',
                'nb_jours' => 5,
                'motif' => 'Vacances Pâques',
                'statut' => 'approuve',
                'commentaire_rh' => 'Approuvé par le RH',
                'created_at' => '2026-04-10 10:30:00',
                'traite_par' => 2,
            ],
            [
                'employe_id' => 7,  // Carla Zafindrafita
                'type_conge_id' => 1,
                'date_debut' => '2026-05-01',
                'date_fin' => '2026-05-05',
                'nb_jours' => 5,
                'motif' => 'Congé mai',
                'statut' => 'approuve',
                'commentaire_rh' => 'Approuvé',
                'created_at' => '2026-04-15 14:00:00',
                'traite_par' => 2,
            ],
            [
                'employe_id' => 8,  // Fady Randrianampoinimerina
                'type_conge_id' => 3,
                'date_debut' => '2026-04-10',
                'date_fin' => '2026-04-12',
                'nb_jours' => 3,
                'motif' => 'Événement familial',
                'statut' => 'approuve',
                'commentaire_rh' => 'Congé spécial approuvé',
                'created_at' => '2026-04-05 09:15:00',
                'traite_par' => 2,
            ],
            
            // REFUSÉES
            [
                'employe_id' => 3,  // Jean Rakoto
                'type_conge_id' => 1,
                'date_debut' => '2026-03-15',
                'date_fin' => '2026-03-22',
                'nb_jours' => 8,
                'motif' => 'Voyage prévu',
                'statut' => 'refuse',
                'commentaire_rh' => 'Chevauchement avec congé collectif',
                'created_at' => '2026-03-01 08:00:00',
                'traite_par' => 2,
            ],
            [
                'employe_id' => 4,  // Sophie Rabemananjara
                'type_conge_id' => 2,
                'date_debut' => '2026-04-01',
                'date_fin' => '2026-04-03',
                'nb_jours' => 3,
                'motif' => 'Maladie',
                'statut' => 'refuse',
                'commentaire_rh' => 'Solde insuffisant',
                'created_at' => '2026-03-20 11:30:00',
                'traite_par' => 2,
            ],
        ];
        
        $statusCounts = ['en_attente' => 0, 'approuve' => 0, 'refuse' => 0];
        foreach ($conges as $conge) {
            $this->db->table('conges')->insert($conge);
            $statusCounts[$conge['statut']]++;
        }
        echo "   ✅ 8 demandes de congés ajoutées\n";
        echo "      • En attente: {$statusCounts['en_attente']}\n";
        echo "      • Approuvées: {$statusCounts['approuve']}\n";
        echo "      • Refusées: {$statusCounts['refuse']}\n\n";

        // ===== 6. MISE A JOUR DES SOLDES =====
        echo "6️⃣  Mise à jour des soldes (jours_pris)...\n";
        
        $updatesCount = 0;
        foreach ($conges as $conge) {
            if ($conge['statut'] === 'approuve') {
                $this->db->table('soldes')
                    ->where('employe_id', $conge['employe_id'])
                    ->where('type_conge_id', $conge['type_conge_id'])
                    ->where('annee', 2026)
                    ->set('jours_pris', 'jours_pris + ' . $conge['nb_jours'], false)
                    ->update();
                $updatesCount++;
            }
        }
        echo "   ✅ {$updatesCount} soldes mis à jour (jours_pris += nb_jours)\n\n";

        // ===== RESUME =====
        echo "════════════════════════════════════════════════════════════\n";
        echo "✅ SEEDING TERMINÉ AVEC SUCCÈS !\n";
        echo "════════════════════════════════════════════════════════════\n\n";

        echo "📋 RÉCAPITULATIF:\n";
        echo "   • 5 Départements\n";
        echo "   • 4 Types de congés\n";
        echo "   • 8 Employés (3 rôles)\n";
        echo "   • 18 Enregistrements de soldes\n";
        echo "   • 8 Demandes de congés (3 en attente, 3 approuvées, 2 refusées)\n\n";

        echo "🔐 IDENTIFIANTS DE CONNEXION:\n\n";

        echo "👨‍💼 ADMINISTRATEUR:\n";
        echo "   Email: admin@techmada.mg\n";
        echo "   Mot de passe: admin123\n";
        echo "   Rôle: admin\n\n";

        echo "👩‍💼 RESPONSABLE RH:\n";
        echo "   Email: rh@techmada.mg\n";
        echo "   Mot de passe: rh123\n";
        echo "   Rôle: rh\n\n";

        echo "👤 EMPLOYÉS:\n";
        echo "   1. jean.rakoto@techmada.mg (IT) — employe123\n";
        echo "   2. sophie.r@techmada.mg (IT) — employe123\n";
        echo "   3. luc.njara@techmada.mg (Ventes) — employe123\n";
        echo "   4. andre.n@techmada.mg (Ventes) — employe123\n";
        echo "   5. carla.z@techmada.mg (Marketing) — employe123\n";
        echo "   6. fady.r@techmada.mg (IT) — employe123\n\n";

        echo "📊 DEMANDES EN ATTENTE:\n";
        echo "   1. Jean Rakoto: 25-29 mai (5 jours - Congé annuel)\n";
        echo "   2. Sophie R: 15-19 juin (5 jours - Congé annuel)\n";
        echo "   3. Luc Njara: 20-22 mai (3 jours - Congé maladie)\n\n";

        echo "🎉 PRÊT À TESTER!\n";
        echo "════════════════════════════════════════════════════════════\n\n";
    }
}
