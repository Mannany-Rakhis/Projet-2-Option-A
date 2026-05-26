<?php
require 'config.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) {
    header('Location: reservations.php');
    exit;
}

$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date_rdv          = trim($_POST['date_rdv']          ?? '');
    $heure_rdv         = trim($_POST['heure_rdv']         ?? '');
    $nom_client        = trim($_POST['nom_client']        ?? '');
    $email_client      = trim($_POST['email_client']      ?? '');
    $telephone         = trim($_POST['telephone']         ?? '');
    $statut            = trim($_POST['statut']            ?? '');
    $Id_services       = (int) ($_POST['Id_services']       ?? 0);
    $Id_disponibilites = (int) ($_POST['Id_disponibilites'] ?? 0);

    $statuts_valides = ['en_attente', 'confirmé', 'annulé'];

    if ($date_rdv === '')                            $erreurs[] = "La date est obligatoire.";
    if ($heure_rdv === '')                           $erreurs[] = "L'heure est obligatoire.";
    if ($nom_client === '')                          $erreurs[] = "Le nom est obligatoire.";
    if (!filter_var($email_client, FILTER_VALIDATE_EMAIL)) $erreurs[] = "Email invalide.";
    if (!preg_match('/^\d{10}$/', $telephone))       $erreurs[] = "Le téléphone doit faire 10 chiffres.";
    if (!in_array($statut, $statuts_valides, true))  $erreurs[] = "Statut invalide.";
    if ($Id_services <= 0)                           $erreurs[] = "Service requis.";
    if ($Id_disponibilites <= 0)                     $erreurs[] = "Disponibilité requise.";

    if (!$erreurs) {
        $stmt = $pdo->prepare(
            "UPDATE reservations
             SET date_rdv = ?, heure_rdv = ?, nom_client = ?, email_client = ?,
                 telephone = ?, statut = ?, Id_services = ?, Id_disponibilites = ?
             WHERE Id_reservations = ?"
        );
        $stmt->execute([
            $date_rdv, $heure_rdv, $nom_client, $email_client,
            $telephone, $statut, $Id_services, $Id_disponibilites, $id,
        ]);
        header('Location: reservations.php?modifie=1');
        exit;
    }
}

$stmt = $pdo->prepare("SELECT * FROM reservations WHERE Id_reservations = ?");
$stmt->execute([$id]);
$resa = $stmt->fetch();

if (!$resa) {
    header('Location: reservations.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $erreurs) {
    $resa = array_merge($resa, [
        'date_rdv'          => $date_rdv,
        'heure_rdv'         => $heure_rdv,
        'nom_client'        => $nom_client,
        'email_client'      => $email_client,
        'telephone'         => $telephone,
        'statut'            => $statut,
        'Id_services'       => $Id_services,
        'Id_disponibilites' => $Id_disponibilites,
    ]);
}

$services       = $pdo->query("SELECT Id_services, nom FROM services ORDER BY nom")->fetchAll();
$disponibilites = $pdo->query("SELECT Id_disponibilites, jour_semaine, heure_debut, heure_fin, actif FROM disponibilites ORDER BY Id_disponibilites")->fetchAll();

$pageTitle = 'ChauveQuiPeut – Modifier la réservation';
include 'includes/header.php';
?>

<main class="container py-5" style="max-width: 720px;">
  <h2 class="mb-4">Modifier la réservation #<?= (int) $resa['Id_reservations'] ?></h2>

  <?php if ($erreurs): ?>
    <div class="alert alert-danger">
      <ul class="mb-0">
        <?php foreach ($erreurs as $e): ?>
          <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <form method="post" novalidate>
    <div class="row g-3">
      <div class="col-md-6">
        <label for="date_rdv" class="form-label">Date</label>
        <input type="date" id="date_rdv" name="date_rdv" class="form-control"
               value="<?= htmlspecialchars($resa['date_rdv']) ?>" required>
      </div>
      <div class="col-md-6">
        <label for="heure_rdv" class="form-label">Heure</label>
        <input type="time" id="heure_rdv" name="heure_rdv" class="form-control"
               value="<?= htmlspecialchars(substr($resa['heure_rdv'], 0, 5)) ?>" required>
      </div>

      <div class="col-md-6">
        <label for="nom_client" class="form-label">Nom du client</label>
        <input type="text" id="nom_client" name="nom_client" class="form-control"
               value="<?= htmlspecialchars($resa['nom_client']) ?>" maxlength="50" required>
      </div>
      <div class="col-md-6">
        <label for="telephone" class="form-label">Téléphone (10 chiffres)</label>
        <input type="tel" id="telephone" name="telephone" class="form-control"
               value="<?= htmlspecialchars($resa['telephone']) ?>" pattern="\d{10}" maxlength="10" required>
      </div>

      <div class="col-12">
        <label for="email_client" class="form-label">Email</label>
        <input type="email" id="email_client" name="email_client" class="form-control"
               value="<?= htmlspecialchars($resa['email_client']) ?>" maxlength="255" required>
      </div>

      <div class="col-md-6">
        <label for="Id_services" class="form-label">Service</label>
        <select id="Id_services" name="Id_services" class="form-select" required>
          <?php foreach ($services as $s): ?>
            <option value="<?= (int) $s['Id_services'] ?>"
              <?= ((int) $s['Id_services'] === (int) $resa['Id_services']) ? 'selected' : '' ?>>
              <?= htmlspecialchars($s['nom']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="col-md-6">
        <label for="Id_disponibilites" class="form-label">Créneau (jour)</label>
        <select id="Id_disponibilites" name="Id_disponibilites" class="form-select" required>
          <?php foreach ($disponibilites as $d): ?>
            <option value="<?= (int) $d['Id_disponibilites'] ?>"
              <?= ((int) $d['Id_disponibilites'] === (int) $resa['Id_disponibilites']) ? 'selected' : '' ?>>
              <?= htmlspecialchars($d['jour_semaine']) ?>
              <?php if ($d['actif'] && $d['heure_fin']): ?>
                (<?= htmlspecialchars(substr($d['heure_debut'], 0, 5)) ?>–<?= htmlspecialchars(substr($d['heure_fin'], 0, 5)) ?>)
              <?php else: ?>
                (fermé)
              <?php endif; ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="col-md-6">
        <label for="statut" class="form-label">Statut</label>
        <select id="statut" name="statut" class="form-select" required>
          <?php foreach (['en_attente', 'confirmé', 'annulé'] as $st): ?>
            <option value="<?= htmlspecialchars($st) ?>" <?= $resa['statut'] === $st ? 'selected' : '' ?>>
              <?= htmlspecialchars($st) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <div class="d-flex gap-2 mt-4">
      <button type="submit" class="btn btn-primary">Enregistrer</button>
      <a href="reservations.php" class="btn btn-secondary">Annuler</a>
    </div>
  </form>
</main>

<?php include 'includes/footer.php'; ?>
