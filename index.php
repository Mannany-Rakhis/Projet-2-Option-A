<?php
require 'config.php';
$services = $pdo->query('SELECT * FROM services')->fetchAll();
$salon = [
    'nom'         => 'ChauveQuiPeut',
    'slogan'      => 'On coupe vite, on coupe bien — même si vous fuyez !',
    'description' => 'Spécialistes des cheveux depuis toujours. Un salon chaleureux au cœur de Valenciennes, où chaque client repart avec le sourire… et moins de cheveux.',
    'adresse'     => '136 av. Alan Turing, 59300 Valenciennes',
    'telephone'   => '03 27 00 00 00',
    'email'       => 'contact@chauve-qui-peut.fr',
    'instagram'   => '@chauvequipeut',
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

$joursFR = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
$aujourdhui = $joursFR[(int) date('w')];

$services = [
    [
        'categorie' => 'Coupe',
        'items'     => [
            ['nom' => 'Coupe homme',         'duree' => '20 min', 'prix' => '18 €'],
            ['nom' => 'Coupe femme',         'duree' => '40 min', 'prix' => '35 €'],
            ['nom' => 'Coupe enfant (–12)',  'duree' => '20 min', 'prix' => '14 €'],
            ['nom' => 'Dégradé / Fade',      'duree' => '30 min', 'prix' => '24 €'],
        ],
    ],
    [
        'categorie' => 'Coloration',
        'items'     => [
            ['nom' => 'Coloration complète', 'duree' => '90 min',  'prix' => '65 €'],
            ['nom' => 'Mèches / Balayage',   'duree' => '120 min', 'prix' => '80 €'],
            ['nom' => 'Retouche racines',    'duree' => '60 min',  'prix' => '45 €'],
            ['nom' => 'Teinture barbe',      'duree' => '20 min',  'prix' => '15 €'],
        ],
    ],
    [
        'categorie' => 'Soins',
        'items'     => [
            ['nom' => 'Soin hydratant',       'duree' => '30 min',  'prix' => '25 €'],
            ['nom' => 'Lissage brésilien',    'duree' => '150 min', 'prix' => '120 €'],
            ['nom' => 'Massage cuir chevelu', 'duree' => '20 min',  'prix' => '18 €'],
        ],
    ],
    [
        'categorie' => 'Barbe',
        'items'     => [
            ['nom' => 'Taille barbe',        'duree' => '20 min', 'prix' => '16 €'],
            ['nom' => 'Rasage traditionnel', 'duree' => '30 min', 'prix' => '22 €'],
            ['nom' => 'Coupe + Barbe',       'duree' => '45 min', 'prix' => '36 €'],
        ],
    ],
];

$pageTitle = $salon['nom'] . ' – Salon de Coiffure';
$pageCss   = 'css/index.css';
include 'includes/header.php';
?>

<section class="hero">
  <div class="container position-relative">
    <div class="row align-items-center">
      <div class="col-lg-7">
        <p class="hero-eyebrow">Salon de coiffure · Valenciennes</p>
        <h1>
          Votre coiffeur<br>
          <em>de confiance</em>
        </h1>
        <a href="#services" class="btn btn-rdv me-3">Voir les prestations</a>
        <a href="ajouter-reservation.php" class="btn btn-rdv" style="background:var(--gold);">Prendre RDV</a>
      </div>
      <div class="col-lg-5 d-none d-lg-flex justify-content-end">
        <div class="hero-aside">
          <p class="hero-aside-label">Aujourd'hui</p>
          <p class="hero-aside-day"><?= htmlspecialchars($aujourdhui) ?></p>
          <p class="hero-aside-hours">
            <?php if ($horaires[$aujourdhui] === 'Fermé'): ?>
              <span class="closed">Fermé</span>
            <?php else: ?>
              <?= htmlspecialchars($horaires[$aujourdhui]) ?>
            <?php endif; ?>
          </p>
          <hr>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="services-section" id="services">
  <div class="container">
    <p class="section-label">Ce que nous faisons</p>
    <h2 class="section-title">Nos prestations</h2>
    <div class="section-line"></div>

    <div class="row g-4">
      <?php foreach ($services as $categorie): ?>
        <div class="col-md-6 col-xl-3">
          <div class="service-category-card">
            <div class="cat-header">
              <h3 class="cat-title"><?= htmlspecialchars($categorie['categorie']) ?></h3>
            </div>
            <?php foreach ($categorie['items'] as $item): ?>
              <div class="service-item">
                <span class="service-name"><?= htmlspecialchars($item['nom']) ?></span>
                <div class="service-meta">
                  <span class="service-duree"><?= htmlspecialchars($item['duree']) ?></span>
                  <span class="service-prix"><?= htmlspecialchars($item['prix']) ?></span>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="horaires-section" id="horaires">
  <div class="container">
    <div class="row align-items-start g-5">
      <div class="col-lg-4">
        <p class="section-label">Quand nous trouver</p>
        <h2 class="section-title">Horaires<br>d'ouverture</h2>
        <div class="section-line"></div>
        <p style="color: rgba(201,184,154,0.6); font-weight:300; line-height:1.8;">
          Nous vous accueillons du mardi au dimanche, sans rendez-vous ou sur réservation.
        </p>
        <a href="reservations.php" class="btn-rdv mt-3 d-inline-block">Réserver en ligne</a>
      </div>
      <div class="col-lg-5 offset-lg-1">
        <table class="horaires-table">
          <?php foreach ($horaires as $jour => $heure): ?>
            <tr class="<?= ($jour === $aujourdhui) ? 'today' : '' ?>">
              <td><?= htmlspecialchars($jour) ?></td>
              <td>
                <?php if ($heure === 'Fermé'): ?>
                  <span class="badge-ferme">Fermé</span>
                <?php else: ?>
                  <?= htmlspecialchars($heure) ?>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>
    </div>
  </div>
</section>

<section class="infos-section" id="infos">
  <div class="container">
    <p class="section-label text-center">Nous contacter</p>
    <h2 class="section-title text-center"><?= htmlspecialchars($salon['nom']) ?></h2>
    <div class="section-line mx-auto"></div>
    <p class="text-center mb-5" style="color:var(--muted); max-width:520px; margin:0 auto 48px; font-weight:300; line-height:1.8;">
      <?= htmlspecialchars($salon['slogan']) ?>
    </p>
    <div class="row g-4 justify-content-center">
      <div class="col-md-6 col-lg-3">
        <div class="info-card">
          <div class="info-icon"><i class="ti ti-map-pin"></i></div>
          <div>
            <p class="info-label">Adresse</p>
            <p class="info-value"><?= nl2br(htmlspecialchars($salon['adresse'])) ?></p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="info-card">
          <div class="info-icon"><i class="ti ti-phone"></i></div>
          <div>
            <p class="info-label">Téléphone</p>
            <p class="info-value">
              <a href="tel:<?= preg_replace('/\s/', '', $salon['telephone']) ?>">
                <?= htmlspecialchars($salon['telephone']) ?>
              </a>
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="info-card">
          <div class="info-icon"><i class="ti ti-mail"></i></div>
          <div>
            <p class="info-label">Email</p>
            <p class="info-value">
              <a href="mailto:<?= htmlspecialchars($salon['email']) ?>">
                <?= htmlspecialchars($salon['email']) ?>
              </a>
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="info-card">
          <div class="info-icon"><i class="ti ti-brand-instagram"></i></div>
          <div>
            <p class="info-label">Instagram</p>
            <p class="info-value"><?= htmlspecialchars($salon['instagram']) ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
