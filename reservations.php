<?php
require 'config.php';

// B.4 : Récupération des réservations avec JOIN
$sql = "SELECT r.*, s.nom as service_nom 
        FROM reservations r 
        LEFT JOIN services s ON r.Id_services = s.Id_services 
        ORDER BY r.date_rdv DESC, r.heure_rdv DESC";
$reservations = $pdo->query($sql)->fetchAll();

$pageTitle = 'ChauveQuiPeut – Réservations';
include 'includes/header.php';
?>

<main class="container py-5">
  <h2 class="mb-3">
    Réservations
    <a href="ajouter-reservation.php" class="btn btn-success float-end">+ Nouvelle réservation</a>
  </h2>

<!-- D.5 : Message de suppression -->
<?php if (isset($_GET['supprime'])): ?>
    <div class="alert alert-success">Réservation supprimée avec succès.</div>
  <?php endif; ?>
  <?php if (isset($_GET['modifie'])): ?>
    <div class="alert alert-success">Réservation modifiée avec succès.</div>
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
                <td><?= htmlspecialchars($resa['date_rdv']) ?></td>
                <td><?= htmlspecialchars($resa['heure_rdv']) ?></td>
                <td><?= htmlspecialchars($resa['service_nom'] ?? 'Non défini') ?></td>
                <td>
                    <span class="badge bg-<?= $resa['statut'] === 'annulé' ? 'danger' : 'success' ?>">
                        <?= htmlspecialchars($resa['statut']) ?>
                    </span>
                </td>
                <td>
                    <!-- C.3 & D.2 : Liens UPDATE / DELETE -->
                    <a href="modifier-reservation.php?id=<?= (int)$resa['Id_reservations'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                    <a href="supprimer-reservation.php?id=<?= (int)$resa['Id_reservations'] ?>" 
                       class="btn btn-sm btn-danger" 
                       onclick="return confirm('Supprimer cette réservation ?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</main>

<?php include 'includes/footer.php'; ?>
