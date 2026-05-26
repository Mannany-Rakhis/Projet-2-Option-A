<?php
require 'config.php';

$salon = [
    'nom'       => 'ChauveQuiPeut',
    'adresse'   => ['136 Av. Alan Turing', '59410 Anzin'],
    'telephone' => '03 27 00 00 00',
    'email'     => 'contact@chauve-qui-peut.fr',
];

$horaires = [
    'Lundi'    => 'Fermé',
    'Mardi'    => '9h00 – 19h00',
    'Mercredi' => '9h00 – 19h00',
    'Jeudi'    => '9h00 – 19h00',
    'Vendredi' => '9h00 – 19h00',
    'Samedi'   => '9h00 – 19h00',
    'Dimanche' => '9h00 – 19h00',
];

$pageTitle = $salon['nom'] . ' – Contact';
$pageCss   = 'css/contact.css';
include 'includes/header.php';
?>

<main class="contact-main">
  <div class="contact-info">
    <div class="contact-titre">
      <h1>Nous contacter</h1>
    </div>

    <div>
      <h4>Adresse</h4>
      <address>
        <?php foreach ($salon['adresse'] as $ligne): ?>
          <p><?= htmlspecialchars($ligne) ?></p>
        <?php endforeach; ?>
      </address>
    </div>

    <div>
      <h4>Horaires d'ouverture</h4>
      <div class="contact-horaires">
        <?php foreach ($horaires as $jour => $heure): ?>
          <span><?= htmlspecialchars($jour) ?> — <?= htmlspecialchars($heure) ?></span>
        <?php endforeach; ?>
      </div>
    </div>

    <div>
      <h4>Téléphone</h4>
      <p>
        <a href="tel:<?= preg_replace('/\s/', '', $salon['telephone']) ?>">
          <?= htmlspecialchars($salon['telephone']) ?>
        </a>
      </p>
    </div>

    <div>
      <h4>Email</h4>
      <p>
        <a href="mailto:<?= htmlspecialchars($salon['email']) ?>">
          <?= htmlspecialchars($salon['email']) ?>
        </a>
      </p>
    </div>
  </div>

  <div class="contact-map">
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2544.6901503235304!2d3.517362976752171!3d50.37233187157732!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c2eddbd69aa3c7%3A0x4c820465e05a0851!2s130%20Av.%20Alan%20Turing%2C%2059410%20Anzin!5e0!3m2!1sen!2sfr!4v1779626359865!5m2!1sen!2sfr"
      allowfullscreen
      loading="lazy"
      referrerpolicy="no-referrer-when-downgrade"
      title="Carte du salon"></iframe>
  </div>
</main>

<?php include 'includes/footer.php'; ?>
