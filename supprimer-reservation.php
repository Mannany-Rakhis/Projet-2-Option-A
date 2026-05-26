<?php
require "config.php";

// Récupération de l'ID passé en paramètre
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Suppression si l'ID est valide
if ($id > 0) {
    $stmt = $pdo->prepare("DELETE FROM reservations WHERE Id_reservations = ?");
    $stmt->execute([$id]);
}

// Retour à la liste
header("Location: reservations.php?supprime=1");
exit;
?>