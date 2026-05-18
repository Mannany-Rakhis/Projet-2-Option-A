<?php
require "config.php";
require "includes/header.php";

// B.4 : Récupération des réservations avec JOIN
$sql = "SELECT r.*, s.nom as service_nom 
        FROM reservations r 
        LEFT JOIN services s ON r.service_id = s.id 
        ORDER BY r.date_rdv DESC, r.heure_rdv DESC";
$stmt = $pdo->query($sql);
$reservations = $stmt->fetchAll();
?>

<h2 class="mb-3">
    Réservations
    <!-- D.1 : Bouton vers ajout -->
    <a href="ajouter-reservation.php" class="btn btn-success float-end">+ Nouvelle réservation</a>
</h2>

<!-- Message de suppression (bonus D.5) -->
<?php if (isset($_GET['supprime'])): ?>
    <div class="alert alert-success">Réservation supprimée avec succès.</div>
<?php endif; ?>

<?php if (empty($reservations)): ?>
    <div class="alert alert-warning">Aucune réservation pour le moment.</div>
<?php else: ?>
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Client</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Service</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($reservations as $resa): ?>
            <tr>
                <td><?= htmlspecialchars($resa['nom_client']) ?></td>
                <td><?= htmlspecialchars($resa['email_client']) ?></td>
                <td><?= htmlspecialchars($resa['telephone']) ?></td>
                <td><?= $resa['date_rdv'] ?></td>
                <td><?= $resa['heure_rdv'] ?></td>
                <td><?= htmlspecialchars($resa['service_nom'] ?? 'Non défini') ?></td>
                <td><span class="badge bg-<?= $resa['statut'] === 'annulé' ? 'danger' : 'success' ?>">
                    <?= htmlspecialchars($resa['statut']) ?>
                </span></td>
                <td>
                    <!-- C.3 & D.2 : Liens UPDATE / DELETE -->
                    <a href="modifier-reservation.php?id=<?= (int)$resa['id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                    <a href="supprimer-reservation.php?id=<?= (int)$resa['id'] ?>" 
                       class="btn btn-sm btn-danger" 
                       onclick="return confirm('Supprimer cette réservation ?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require "includes/footer.php"; ?>