<?php
$pageTitle = $pageTitle ?? 'ChauveQuiPeut – Salon de Coiffure';
$pageCss   = $pageCss   ?? null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= htmlspecialchars($pageTitle) ?></title>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Jost:wght@300;400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" />

  <link rel="stylesheet" href="css/style.css" />
  <?php if ($pageCss): ?>
    <link rel="stylesheet" href="<?= htmlspecialchars($pageCss) ?>" />
  <?php endif; ?>
</head>
<body>
<header class="site-header">
  <div class="top-bar">
    <div class="top-bar-left">
      <i class="ti ti-map-pin" aria-hidden="true"></i>
      136 av Alan Turing
      <span class="sep">·</span>
      <i class="ti ti-clock" aria-hidden="true"></i>
      Mar–Dim : 9h–19h
    </div>
    <div class="top-bar-right">
      <i class="ti ti-phone" aria-hidden="true"></i>
      <a href="tel:0123456789">03 27 00 00 00</a>
      <span class="sep">·</span>
      <i class="ti ti-brand-instagram" aria-hidden="true"></i>
      <a href="https://instagram.com/ChauveQuiPeut" target="_blank" rel="noopener">@ChauveQuiPeut</a>
    </div>
  </div>

  <div class="header-main">
    <a href="index.php" class="logo-zone" aria-label="ChauveQuiPeut – Accueil">
      <img src="https://cdn.discordapp.com/attachments/1479041217936490670/1506039283239096530/logo_1.png?ex=6a12bea1&is=6a116d21&hm=ac71f9d053ab2b7ea58e9741cc4d7a9af7993bfe2a087ed28f1a302e882762a9&" alt="logo du salon" class="logo-img"/>
      <div class="salon-name">
        <span class="salon-name-main">ChauveQuiPeut</span>
        <span class="salon-name-sub">On coupe vite, on coupe bien — même si vous fuyez !</span>
      </div>
    </a>
    <nav aria-label="Navigation principale">
      <ul class="header-nav">
        <li><a href="index.php">Accueil</a></li>
        <li><a href="reservations.php">Réservations</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </nav>
    <div class="header-actions">
      <button class="icon-btn" aria-label="Rechercher">
        <i class="ti ti-search" aria-hidden="true"></i>
      </button>
      <div class="header-divider" aria-hidden="true"></div>
      <a href="reservations.php" class="btn-rdv">Réserver</a>
      <button class="burger-btn" aria-label="Ouvrir le menu" aria-expanded="false" id="burgerBtn">
        <i class="ti ti-menu-2" aria-hidden="true"></i>
      </button>
    </div>
  </div>



  <nav class="mobile-nav" id="mobileNav" aria-label="Menu mobile">
    <a href="index.php">Accueil</a>
    <a href="reservations.php">Réservations</a>
    <a href="contact.php">Contact</a>
    <a href="reservations.php" class="btn-rdv">Réserver un rendez-vous</a>
  </nav>
</header>

<script>
  const burgerBtn = document.getElementById('burgerBtn');
  const mobileNav = document.getElementById('mobileNav');

  burgerBtn.addEventListener('click', () => {
    const isOpen = mobileNav.style.display === 'flex';
    mobileNav.style.display = isOpen ? 'none' : 'flex';
    burgerBtn.setAttribute('aria-expanded', String(!isOpen));
    burgerBtn.querySelector('.ti').className = isOpen ? 'ti ti-menu-2' : 'ti ti-x';
  });

  const currentPath = window.location.pathname.split('/').pop() || 'index.php';
  document.querySelectorAll('.header-nav a, .mobile-nav a').forEach(link => {
    const href = link.getAttribute('href');
    if (href === currentPath) link.classList.add('active');
    else link.classList.remove('active');
  });
</script>
