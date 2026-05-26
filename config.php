<?php
// =====================================================
// Configuration de la base de données
// =====================================================
define('DB_HOST', 'localhost');
define('DB_NAME', 'salon-coiffure');
define('DB_USER', 'root');
define('DB_PASS', '');

// Connexion à la base via PDO
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>