<?php
require 'config.php';

// Initialisation des variables pour le formulaire
$date_rdv          = '';
$heure_rdv         = '';
$nom_client        = '';
$email_client      = '';
$telephone         = '';
$statut            = 'en_attente';
$Id_services       = 0;
$Id_disponibilites = 0;

$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Nettoyage et récupération des données reçues
    $date_rdv          = trim($_POST['date_rdv'] ?? '');
    $heure_rdv         = trim($_POST['heure_rdv'] ?? '');
    $nom_client        = trim($_POST['nom_client'] ?? '');
    $email_client      = trim($_POST['email_client'] ?? '');
    $telephone         = trim($_POST['telephone'] ?? '');
    $statut            = trim($_POST['statut'] ?? '');
    $Id_services       = (int) ($_POST['Id_services'] ?? 0);
    $Id_disponibilites = (int) ($_POST['Id_disponibilites'] ?? 0);

    $statuts_valides = ['en_attente', 'confirmé', 'annulé'];

    // Validations de sécurité côté serveur
    if ($date_rdv === '')                                  $erreurs[] = "La date est obligatoire.";
    if ($heure_rdv === '')                                 $erreurs[] = "L'heure est obligatoire.";
    if ($nom_client === '')                                $erreurs[] = "Le nom est obligatoire.";
    if (!filter_var($email_client, FILTER_VALIDATE_EMAIL)) $erreurs[] = "Email invalide.";
    if (!preg_match('/^\d{10}$/', $telephone))             $erreurs[] = "Le téléphone doit faire 10 chiffres.";
    if (!in_array($statut, $statuts_valides, true))        $erreurs[] = "Statut invalide.";
    if ($Id_services <= 0)                                 $erreurs[] = "Service requis.";
    if ($Id_disponibilites <= 0)                           $erreurs[] = "Disponibilité requise.";

    // Insertion en base de données si aucune erreur
    if (!$erreurs) {
        $stmt = $pdo->prepare(
            "INSERT INTO reservations 
            (date_rdv, heure_rdv, nom_client, email_client, telephone, statut, Id_services, Id_disponibilites)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $date_rdv, $heure_rdv, $nom_client, $email_client,
            $telephone, $statut, $Id_services, $Id_disponibilites
        ]);
        
        header('Location: reservations.php?cree=1');
        exit;
    }
}

// Chargement des listes pour les éléments du formulaire
$services = $pdo->query("SELECT Id_services, nom FROM services ORDER BY nom")->fetchAll();

// On ne filtre que les créneaux actifs pour la création
$disponibilites = $pdo->query(
    "SELECT Id_disponibilites, jour_semaine, heure_debut, heure_fin, actif 
     FROM disponibilites 
     WHERE actif = 1 
     ORDER BY Id_disponibilites"
)->fetchAll();

$pageTitle = 'ChauveQuiPeut – Nouvelle réservation';
include 'includes/header.php';
?>

<main class="container py-5" style="max-width: 720px;">
  <h2 class="mb-4">Nouvelle réservation</h2>

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
               value="<?= htmlspecialchars($date_rdv) ?>" required>
      </div>
      <div class="col-md-6">
        <label for="heure_rdv" class="form-label">Heure</label>
        <input type="time" id="heure_rdv" name="heure_rdv" class="form-control"
               value="<?= htmlspecialchars(substr($heure_rdv, 0, 5)) ?>" required>
      </div>

      <div class="col-md-6">
        <label for="nom_client" class="form-label">Nom du client</label>
        <input type="text" id="nom_client" name="nom_client" class="form-control"
               value="<?= htmlspecialchars($nom_client) ?>" maxlength="50" required>
      </div>
      <div class="col-md-6">
        <label for="telephone" class="form-label">Téléphone (10 chiffres)</label>
        <input type="tel" id="telephone" name="telephone" class="form-control"
               value="<?= htmlspecialchars($telephone) ?>" pattern="\d{10}" maxlength="10" required>
      </div>

      <div class="col-12">
        <label for="email_client" class="form-label">Email</label>
        <input type="email" id="email_client" name="email_client" class="form-control"
               value="<?= htmlspecialchars($email_client) ?>" maxlength="255" required>
      </div>

      <div class="col-md-6">
        <label for="Id_services" class="form-label">Service</label>
        <select id="Id_services" name="Id_services" class="form-select" required>
          <option value="">-- Choisir un service --</option>
          <?php foreach ($services as $s): ?>
            <option value="<?= (int) $s['Id_services'] ?>"
              <?= ((int) $s['Id_services'] === $Id_services) ? 'selected' : '' ?>>
              <?= htmlspecialchars($s['nom']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="col-md-6">
        <label for="Id_disponibilites" class="form-label">Créneau (jour)</label>
        <select id="Id_disponibilites" name="Id_disponibilites" class="form-select" required>
          <option value="">-- Choisir un créneau --</option>
          <?php foreach ($disponibilites as $d): ?>
            <option value="<?= (int) $d['Id_disponibilites'] ?>"
              <?= ((int) $d['Id_disponibilites'] === $Id_disponibilites) ? 'selected' : '' ?>>
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
            <option value="<?= htmlspecialchars($st) ?>" <?= $statut === $st ? 'selected' : '' ?>>
              <?= htmlspecialchars($st) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <div class="d-flex gap-2 mt-4">
      <button type="submit" class="btn btn-primary">Créer la réservation</button>
      <a href="reservations.php" class="btn btn-secondary">Annuler</a>
    </div>
  </form>
</main>

<?php include 'includes/footer.php'; ?>