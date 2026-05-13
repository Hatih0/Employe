<?php
// Réinitialiser la base de données SQLite en vidant les données

$dbPath = 'F:\Employe\writable\fitspace.db';

try {
    $pdo = new PDO('sqlite:' . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Désactiver les contraintes de clés étrangères temporairement
    $pdo->exec('PRAGMA foreign_keys = OFF');
    
    // Récupérer toutes les tables
    $stmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table'");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    // Vider chaque table
    foreach ($tables as $table) {
        $pdo->exec("DELETE FROM $table");
        echo "Table '$table' vidée\n";
    }
    
    // Réactiver les contraintes
    $pdo->exec('PRAGMA foreign_keys = ON');
    
    echo "\n✅ Base de données réinitialisée avec succès !\n";
    
} catch (PDOException $e) {
    die("❌ Erreur : " . $e->getMessage());
}
