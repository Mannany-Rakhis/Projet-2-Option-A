<?php
// D.2 : Connexion à la base de données
require "config.php";

// 1. Récupération de l'ID depuis l'URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// 2. Suppression uniquement si l'ID est valide (> 0)
if ($id > 0) {
    // ⚠️ SÉCURITÉ OBLIGATOIRE :
    // - Requête préparée (évite injection SQL)
    // - WHERE obligatoire (évite de vider toute la table)
    $stmt = $pdo->prepare("DELETE FROM reservations WHERE Id_reservations = ?");
    $stmt->execute([$id]);
}

// 3. Redirection vers la liste + paramètre pour afficher le message de succès
header("Location: reservations.php?supprime=1");
exit; // Toujours mettre exit après un header() pour stopper le script