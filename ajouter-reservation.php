<?php
require "config.php";
require "includes/header.php";

// Récupération des services pour le select
$services = $pdo->query("SELECT Id_services, nom, duree_minutes, prix_euros FROM services ORDER BY nom")->fetchAll();

$erreurs = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom_client   = trim($_POST['nom_client'] ?? '');
    $email_client = trim($_POST['email_client'] ?? '');
    $telephone    = trim($_POST['telephone'] ?? '');
    $date_rdv     = $_POST['date_rdv'] ?? '';
    $heure_rdv    = $_POST['heure_rdv'] ?? '';
    $Id_services  = (int)($_POST['Id_services'] ?? 0);

    if (empty($nom_client))    $erreurs[] = "Le nom est obligatoire.";
    if (empty($email_client) || !filter_var($email_client, FILTER_VALIDATE_EMAIL))
                                $erreurs[] = "L'email est invalide.";
    if (empty($telephone))     $erreurs[] = "Le téléphone est obligatoire.";
    if (empty($date_rdv))      $erreurs[] = "La date est obligatoire.";
    if (empty($heure_rdv))     $erreurs[] = "L'heure est obligatoire.";
    if ($Id_services <= 0)     $erreurs[] = "Veuillez choisir un service.";

    if (!empty($date_rdv) && $date_rdv < date('Y-m-d')) {
        $erreurs[] = "La date ne peut pas être dans le passé.";
    }

    if (empty($erreurs)) {
        $check = $pdo->prepare("SELECT COUNT(*) FROM reservations WHERE date_rdv = ? AND heure_rdv = ?");
        $check->execute([$date_rdv, $heure_rdv]);
        if ($check->fetchColumn() > 0) {
            $erreurs[] = "Ce créneau est déjà réservé. Choisissez un autre horaire.";
        }
    }

    if (empty($erreurs)) {
        $stmt = $pdo->prepare("
            INSERT INTO reservations (nom_client, email_client, telephone, date_rdv, heure_rdv, Id_services, statut)
            VALUES (?, ?, ?, ?, ?, ?, 'en_attente')
        ");
        $stmt->execute([$nom_client, $email_client, $telephone, $date_rdv, $heure_rdv, $Id_services]);
        $success = true;
    }
}
?>

<style>
  .resa-wrapper {
    min-height: calc(100vh - 200px);
    background: #f0ebe4;
    display: flex;
    align-items: flex-start;
    justify-content: center;
    padding: 60px 20px;
  }

  .resa-card {
    background: #faf8f5;
    width: 100%;
    max-width: 620px;
    border: 1px solid #e8e0d5;
    padding: 52px 48px;
  }

  .resa-eyebrow {
    font-size: 11px;
    letter-spacing: 0.25em;
    text-transform: uppercase;
    color: #8a6f50;
    margin-bottom: 10px;
    font-family: 'Jost', sans-serif;
    font-weight: 400;
  }

  .resa-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 36px;
    font-weight: 400;
    color: #2c2218;
    line-height: 1.15;
    margin-bottom: 8px;
  }

  .resa-subtitle {
    font-size: 13px;
    color: #7a6a5a;
    font-weight: 300;
    margin-bottom: 40px;
    line-height: 1.6;
  }

  .resa-divider {
    width: 40px;
    height: 1px;
    background: #8a6f50;
    margin-bottom: 40px;
  }

  .resa-section-label {
    font-size: 10px;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: #8a6f50;
    margin-bottom: 20px;
    margin-top: 36px;
    font-family: 'Jost', sans-serif;
  }

  .resa-section-label:first-of-type {
    margin-top: 0;
  }

  .resa-field {
    margin-bottom: 20px;
  }

  .resa-field label {
    display: block;
    font-size: 11px;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: #7a6a5a;
    margin-bottom: 8px;
    font-family: 'Jost', sans-serif;
    font-weight: 400;
  }

  .resa-field input,
  .resa-field select {
    width: 100%;
    border: 1px solid #e8e0d5;
    border-radius: 0;
    background: #fff;
    padding: 12px 16px;
    font-family: 'Jost', sans-serif;
    font-size: 14px;
    color: #2c2218;
    outline: none;
    transition: border-color 0.2s;
    appearance: none;
    -webkit-appearance: none;
  }

  .resa-field input:focus,
  .resa-field select:focus {
    border-color: #8a6f50;
  }

  .resa-field input::placeholder {
    color: #b8a898;
  }

  .select-wrapper {
    position: relative;
  }

  .select-wrapper::after {
    content: '↓';
    position: absolute;
    right: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #8a6f50;
    font-size: 13px;
    pointer-events: none;
  }

  .resa-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
  }

  .resa-alert-error {
    background: #fdf0f0;
    border: 1px solid #e8c5c5;
    padding: 16px 20px;
    margin-bottom: 28px;
    font-size: 13px;
    color: #8b3a3a;
  }

  .resa-alert-error ul {
    margin: 0;
    padding-left: 16px;
  }

  .resa-alert-success {
    background: #f0f5f0;
    border: 1px solid #c5d8c5;
    padding: 40px 24px;
    text-align: center;
  }

  .resa-alert-success .success-icon {
    font-size: 32px;
    margin-bottom: 12px;
    color: #5a8a5a;
  }

  .resa-alert-success p {
    font-family: 'Cormorant Garamond', serif;
    font-size: 24px;
    color: #2c2218;
    margin-bottom: 6px;
  }

  .resa-alert-success span {
    font-size: 13px;
    color: #7a6a5a;
  }

  .resa-alert-success a {
    color: #8a6f50;
    text-decoration: none;
    font-size: 11px;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    display: inline-block;
    margin-top: 20px;
    border-bottom: 1px solid #c9b89a;
    padding-bottom: 2px;
  }

  .btn-resa-submit {
    background: #2c2218;
    color: #f0ebe4;
    border: none;
    padding: 15px 40px;
    font-family: 'Jost', sans-serif;
    font-size: 12px;
    font-weight: 400;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    cursor: pointer;
    transition: background 0.2s;
    width: 100%;
    margin-top: 12px;
  }

  .btn-resa-submit:hover {
    background: #8a6f50;
  }

  .btn-resa-cancel {
    display: block;
    text-align: center;
    margin-top: 14px;
    font-size: 12px;
    color: #7a6a5a;
    text-decoration: none;
    letter-spacing: 0.08em;
  }

  .btn-resa-cancel:hover {
    color: #2c2218;
  }

  @media (max-width: 600px) {
    .resa-card { padding: 36px 24px; }
    .resa-row { grid-template-columns: 1fr; }
  }
</style>

<div class="resa-wrapper">
  <div class="resa-card">

    <div class="resa-eyebrow">Salon ChauveQuiPeut</div>
    <h1 class="resa-title">Prendre rendez-vous</h1>
    <p class="resa-subtitle">Remplissez le formulaire ci-dessous et nous confirmerons votre réservation dans les plus brefs délais.</p>
    <div class="resa-divider"></div>

    <?php if ($success): ?>
      <div class="resa-alert-success">
        <div class="success-icon">✓</div>
        <p>Réservation enregistrée</p>
        <span>Vous recevrez une confirmation prochainement.</span><br>
        <a href="reservations.php">Voir toutes les réservations</a>
      </div>

    <?php else: ?>

      <?php if (!empty($erreurs)): ?>
        <div class="resa-alert-error">
          <ul>
            <?php foreach ($erreurs as $e): ?>
              <li><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <form method="POST" action="">

        <div class="resa-section-label">Vos informations</div>

        <div class="resa-field">
          <label for="nom_client">Nom complet</label>
          <input type="text" id="nom_client" name="nom_client"
                 placeholder="Jean Dupont"
                 value="<?= htmlspecialchars($_POST['nom_client'] ?? '') ?>" required>
        </div>

        <div class="resa-row">
          <div class="resa-field">
            <label for="email_client">Email</label>
            <input type="email" id="email_client" name="email_client"
                   placeholder="jean@email.com"
                   value="<?= htmlspecialchars($_POST['email_client'] ?? '') ?>" required>
          </div>
          <div class="resa-field">
            <label for="telephone">Téléphone</label>
            <input type="tel" id="telephone" name="telephone"
                   placeholder="0612345678"
                   value="<?= htmlspecialchars($_POST['telephone'] ?? '') ?>" required>
          </div>
        </div>

        <div class="resa-section-label">Votre rendez-vous</div>

        <div class="resa-field">
          <label for="Id_services">Service souhaité</label>
          <div class="select-wrapper">
            <select id="Id_services" name="Id_services" required>
              <option value="">-- Choisir un service --</option>
              <?php foreach ($services as $s): ?>
                <option value="<?= $s['Id_services'] ?>"
                  <?= (isset($_POST['Id_services']) && $_POST['Id_services'] == $s['Id_services']) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($s['nom']) ?> — <?= $s['duree_minutes'] ?>min — <?= $s['prix_euros'] ?>€
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="resa-row">
          <div class="resa-field">
            <label for="date_rdv">Date</label>
            <input type="date" id="date_rdv" name="date_rdv"
                   min="<?= date('Y-m-d') ?>"
                   value="<?= htmlspecialchars($_POST['date_rdv'] ?? '') ?>" required>
          </div>
          <div class="resa-field">
            <label for="heure_rdv">Heure</label>
            <input type="time" id="heure_rdv" name="heure_rdv"
                   min="09:00" max="19:00"
                   value="<?= htmlspecialchars($_POST['heure_rdv'] ?? '') ?>" required>
          </div>
        </div>

        <button type="submit" class="btn-resa-submit">Confirmer la réservation</button>
        <a href="reservations.php" class="btn-resa-cancel">Annuler</a>

      </form>
    <?php endif; ?>

  </div>
</div>

<?php require "includes/footer.php"; ?>