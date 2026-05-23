
<?php
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
$jourActuel = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
$joursFR    = ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'];
$indexAujourdhui = (int) date('w');
$aujourdhui = $joursFR[$indexAujourdhui];
$services = [
    [
        'categorie' => 'Coupe',
        'icone'     => '',
        'items'     => [
            ['nom' => 'Coupe homme',         'duree' => '20 min', 'prix' => '18 €'],
            ['nom' => 'Coupe femme',         'duree' => '40 min', 'prix' => '35 €'],
            ['nom' => 'Coupe enfant (–12)',  'duree' => '20 min', 'prix' => '14 €'],
            ['nom' => 'Dégradé / Fade',      'duree' => '30 min', 'prix' => '24 €'],
        ],
    ],
    [
        'categorie' => 'Coloration',
        'icone'     => '',
        'items'     => [
            ['nom' => 'Coloration complète', 'duree' => '90 min', 'prix' => '65 €'],
            ['nom' => 'Mèches / Balayage',   'duree' => '120 min','prix' => '80 €'],
            ['nom' => 'Retouche racines',     'duree' => '60 min', 'prix' => '45 €'],
            ['nom' => 'Teinture barbe',       'duree' => '20 min', 'prix' => '15 €'],
        ],
    ],
    [
        'categorie' => 'Soins',
        'icone'     => '',
        'items'     => [
            ['nom' => 'Soin hydratant',      'duree' => '30 min', 'prix' => '25 €'],
            ['nom' => 'Lissage brésilien',   'duree' => '150 min','prix' => '120 €'],
            ['nom' => 'Massage cuir chevelu','duree' => '20 min', 'prix' => '18 €'],
        ],
    ],
    [
        'categorie' => 'Barbe',
        'icone'     => '',
        'items'     => [
            ['nom' => 'Taille barbe',        'duree' => '20 min', 'prix' => '16 €'],
            ['nom' => 'Rasage traditionnel', 'duree' => '30 min', 'prix' => '22 €'],
            ['nom' => 'Coupe + Barbe',       'duree' => '45 min', 'prix' => '36 €'],
        ],
    ],
];
?>
<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= htmlspecialchars($salon['nom']) ?> – Salon de Coiffure</title>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" />

  <style>
    :root {
      --gold:       #8a6f50;
      --gold-lt:    #c9b89a;
      --dark:       #2c2218;
      --bg:         #faf8f5;
      --bg-alt:     #f0ebe4;
      --text:       #2c2218;
      --muted:      #7a6a5a;
      --border:     #e8e0d5;
    }

    * { box-sizing: border-box; }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--bg);
      color: var(--text);
      font-size: 0.95rem;
    }

    h1, h2, h3, h4 {
      font-family: 'Playfair Display', serif;
    }
    .topbar {
      background: var(--dark);
      color: var(--gold-lt);
      font-size: 0.78rem;
      letter-spacing: 0.06em;
      padding: 7px 0;
    }
    .topbar a { color: var(--gold-lt); text-decoration: none; }
    .topbar a:hover { color: #fff; }
    .navbar {
      background: var(--bg) !important;
      border-bottom: 1px solid var(--border);
    }
    .navbar-brand {
      font-family: 'Playfair Display', serif;
      font-size: 1.5rem;
      color: var(--dark) !important;
    }
    .navbar-brand span { color: var(--gold); }
    .nav-link {
      color: var(--muted) !important;
      font-size: 0.82rem;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      font-weight: 400;
    }
    .nav-link:hover, .nav-link.active { color: var(--gold) !important; }
    .btn-rdv {
      background: var(--dark);
      color: #f0ebe4 !important;
      font-size: 0.78rem;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      padding: 8px 20px;
      border: none;
      border-radius: 0;
      transition: background 0.2s;
    }
    .btn-rdv:hover { background: var(--gold); }
    .hero {
      background: var(--dark);
      color: #f0ebe4;
      padding: 100px 0 80px;
      position: relative;
      overflow: hidden;
    }
    .hero-eyebrow {
      font-size: 0.75rem;
      letter-spacing: 0.3em;
      text-transform: uppercase;
      color: var(--gold-lt);
      margin-bottom: 20px;
    }
    .hero h1 {
      font-size: clamp(2.5rem, 6vw, 4.5rem);
      font-weight: 700;
      line-height: 1.1;
      margin-bottom: 24px;
    }
    .hero h1 em {
      font-style: italic;
      color: var(--gold-lt);
    }
    .hero-desc {
      font-size: 1rem;
      font-weight: 300;
      color: #c9b89a;
      max-width: 480px;
      line-height: 1.8;
      margin-bottom: 36px;
    }
    .hero-badge {
      display: inline-block;
      border: 1px solid #f0ebe4;
      color: var(--gold-lt);
      font-size: 0.75rem;
      letter-spacing: 0.1em;
      padding: 6px 16px;
      margin-bottom: 12px;
    }
    .section-label {
      font-size: 0.72rem;
      letter-spacing: 0.28em;
      text-transform: uppercase;
      color: var(--gold);
      margin-bottom: 10px;
    }
    .section-title {
      font-size: clamp(1.8rem, 3vw, 2.6rem);
      font-weight: 700;
      color: var(--dark);
      margin-bottom: 8px;
    }
    .section-line {
      width: 40px;
      height: 2px;
      background: var(--gold);
      margin: 16px 0 40px;
    }
    .section-line.mx-auto { margin-left: auto; margin-right: auto; }
    .services-section { padding: 80px 0; background: var(--bg); }

    .service-category-card {
      background: #fff;
      border: 1px solid var(--border);
      padding: 32px 28px;
      height: 100%;
    }
    .cat-icon { font-size: 1.4rem; }
    .cat-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.2rem;
      font-weight: 700;
      color: var(--dark);
      margin: 0;
    }
    .service-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 0;
      border-bottom: 1px dashed var(--border);
      gap: 12px;
    }
    .service-item:last-child { border-bottom: none; }

    .service-name {
      font-size: 0.9rem;
      color: var(--text);
      font-weight: 400;
    }
    .service-meta {
      display: flex;
      align-items: center;
      gap: 12px;
      flex-shrink: 0;
    }
    .service-duree {
      font-size: 0.75rem;
      color: var(--muted);
      background: var(--bg-alt);
      padding: 3px 8px;
      border-radius: 2px;
    }
    .service-prix {
      font-family: 'Playfair Display', serif;
      font-size: 1rem;
      font-weight: 700;
      color: var(--gold);
      min-width: 48px;
      text-align: right;
    }
    .horaires-section {
      padding: 80px 0;
      background: var(--dark);
      color: #f0ebe4;
    }
    .horaires-section .section-title { color: #f0ebe4; }
    .horaires-section .section-label { color: var(--gold-lt); }

    .horaires-table {
      width: 100%;
      border-collapse: collapse;
    }
    .horaires-table tr {
      border-bottom: 1px solid #f0ebe4;
    }
    .horaires-table tr:last-child { border-bottom: none; }
    .horaires-table td {
      padding: 13px 0;
      font-size: 0.9rem;
      font-weight: 300;
      color: #c9b89a;
    }
    .horaires-table td:first-child {
      font-weight: 400;
      color: #f0ebe4;
      width: 50%;
    }
    .horaires-table td:last-child { text-align: right; }
    .horaires-table tr.today td {
      color: var(--gold-lt);
      font-weight: 500;
    }
    .horaires-table tr.today td:first-child::after {
      content: ' ←';
      font-size: 0.75rem;
      opacity: 0.6;
    }
    .badge-ferme {
      color: rgba(201,184,154,0.4);
      font-style: italic;
    }
    .infos-section { padding: 80px 0; background: var(--bg-alt); }

    .info-card {
      background: #fff;
      border: 1px solid var(--border);
      padding: 28px 24px;
      display: flex;
      gap: 16px;
      align-items: flex-start;
      height: 100%;
    }
    .info-icon {
      width: 44px;
      height: 44px;
      color: var(--gold-lt);
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .info-label {
      font-size: 0.7rem;
      letter-spacing: 0.15em;
      text-transform: uppercase;
      color: var(--gold);
      margin-bottom: 6px;
    }
    .info-value {
      font-size: 0.9rem;
      color: var(--text);
      line-height: 1.6;
      font-weight: 300;
    }
    .info-value a {
      color: var(--text);
      text-decoration: none;
    }
    .info-value a:hover { color: var(--gold); }
  </style>
</head>
<body>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav mx-auto gap-lg-2">
        <li class="nav-item"><a class="nav-link active" href="#">Accueil</a></li>
        <li class="nav-item"><a class="nav-link" href="#services">Prestations</a></li>
        <li class="nav-item"><a class="nav-link" href="#disponibilite">Horaires</a></li>
        <li class="nav-item"><a class="nav-link" href="#infos">Contact</a></li>
      </ul>
      <a href="reservation.php" class="btn btn-rdv ms-lg-3">Réserver</a>
    </div>
  </div>
</nav>
<section class="hero">
  <div class="container position-relative">
    <div class="row align-items-center">
      <div class="col-lg-7">
        <p class="hero-eyebrow">Salon de coiffure · Valenciennes</p>
        <h1>
          Votre coiffeur<br>
          <em>de confiance</em>
        </h1>
        <p class="hero-desc"><?= htmlspecialchars($salon['description']) ?></p>
        <a href="#services" class="btn btn-rdv me-3">Voir les prestations</a>
        <a href="reservation.php" class="btn btn-rdv" style="background:var(--gold);">Prendre RDV</a>
      </div>
      <div class="col-lg-5 d-none d-lg-flex justify-content-end">
        <div style="border: 1px solid #f0ebe4; padding: 32px; text-align:center;">
          <p style="font-size:0.7rem; letter-spacing:0.2em; color:var(--gold-lt); text-transform:uppercase; margin-bottom:20px;">Aujourd'hui</p>
          <p style="font-family:'Playfair Display',serif; font-size:1.1rem; color: #f0ebe4; margin-bottom:6px;"><?= $aujourdhui ?></p>
          <p style="font-size:1.4rem; color:var(--gold-lt); font-weight:300;">
            <?= $horaires[$aujourdhui] === 'Fermé' ? '<span style="font-style:italic; opacity:0.5;">Fermé</span>' : htmlspecialchars($horaires[$aujourdhui]) ?>
          </p>
          <hr style="border-color: #f0ebe4; margin: 20px 0;">

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
      <?php foreach ($services as $categorie) : ?>
      <div class="col-md-6 col-xl-3">
        <div class="service-category-card">
          <div class="cat-header">
            <span class="cat-icon"><?= $categorie['icone'] ?></span>
            <h3 class="cat-title"><?= htmlspecialchars($categorie['categorie']) ?></h3>
          </div>
          <?php foreach ($categorie['items'] as $item) : ?>
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
        <p style="color:rgba(201,184,154,0.6); font-weight:300; line-height:1.8;">
          Nous vous accueillons du mardi au dimanche, sans rendez-vous ou sur réservation.
        </p>
        <a href="reservation.php" class="btn btn-rdv mt-3 d-inline-block">Réserver en ligne</a>
      </div>
      <div class="col-lg-5 offset-lg-1">
        <table class="horaires-table">
          <?php foreach ($horaires as $jour => $heure) : ?>
          <tr class="<?= ($jour === $aujourdhui) ? 'today' : '' ?>">
            <td><?= htmlspecialchars($jour) ?></td>
            <td>
              <?php if ($heure === 'Fermé') : ?>
                <span class="badge-ferme">Fermé</span>
              <?php else : ?>
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
          <div class="info-icon"></div>
          <div>
            <p class="info-label">Adresse</p>
            <p class="info-value"><?= nl2br(htmlspecialchars($salon['adresse'])) ?></p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="info-card">
          <div class="info-icon"></div>
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
          <div class="info-icon"></div>
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
          <div class="info-icon"></div>
          <div>
            <p class="info-label">Instagram</p>
            <p class="info-value"><?= htmlspecialchars($salon['instagram']) ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</section>
<?php include 'footer.php'; ?>
</body>
</html>