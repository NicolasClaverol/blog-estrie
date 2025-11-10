<?php
require_once 'config/database.php';

echo "<h1>Test de connexion à la base de données</h1>";

try {
    $pdo = getConnection();
    echo "<p style='color: green;'>✅ Connexion réussie à la base de données !</p>";
    
    // Test : récupération des tables
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "<h2>Tables trouvées :</h2>";
    echo "<ul>";
    foreach ($tables as $table) {
        echo "<li>$table</li>";
    }
    echo "</ul>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Erreur : " . $e->getMessage() . "</p>";
}
?>
