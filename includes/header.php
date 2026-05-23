<?php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title> Salon de Coiffure</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Jost:wght@300;400;500&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" />

  <style>
    *, *::before, *::after {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    :root {
      --bg-page:        #faf8f5;
      --bg-dark:        #2c2218;
      --bg-topbar:      #2c2218;
      --color-gold:     #8a6f50;
      --color-gold-lt:  #c9b89a;
      --color-text:     #2c2218;
      --color-muted:    #7a6a5a;
      --color-border:   #e8e0d5;
      --font-serif:     'Cormorant Garamond', Georgia, serif;
      --font-sans:      'Jost', sans-serif;
    }
    body {
      font-family: var(--font-sans);
      background: #f0ebe4; 
    }
    .site-header {
      width: 100%;
      background: var(--bg-page);
      border-bottom: 1px solid var(--color-border);
      position: sticky;        /* reste en haut au scroll */
      top: 0;
      z-index: 1000;
    }
    .top-bar {
      background: var(--bg-topbar);
      color: var(--color-gold-lt);
      font-size: 12px;
      font-weight: 300;
      letter-spacing: 0.07em;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 7px 48px;
    }
    .top-bar a {
      color: var(--color-gold-lt);
      text-decoration: none;
      transition: color 0.2s;
    }
    .top-bar a:hover {
      color: #fff;
    }
    .top-bar-left,
    .top-bar-right {
      display: flex;
      align-items: center;
      gap: 6px;
    }
    .top-bar .sep {
      margin: 0 8px;
      opacity: 0.4;
    }
    .top-bar .ti {
      font-size: 13px;
      vertical-align: -1px;
    }
    .header-main {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 48px;
      height: 88px;
      gap: 32px;
    }
    .logo-zone {
      display: flex;
      align-items: center;
      gap: 16px;
      min-width: 200px;
      text-decoration: none;
    }
    .logo-img {
      width: 100px;
      height: 70px;
      border-radius: 50%;
      object-fit: contain;
      flex-shrink: 0;
    }
    .salon-name {
      display: flex;
      flex-direction: column;
    }
    .salon-name-main {
      font-family: var(--font-serif);
      font-size: 26px;
      font-weight: 600;
      color: var(--color-text);
      letter-spacing: 0.04em;
      line-height: 1;
    }
    .salon-name-sub {
      font-size: 10px;
      font-weight: 300;
      color: var(--color-muted);
      letter-spacing: 0.25em;
      text-transform: uppercase;
      margin-top: 5px;
    }
    .header-nav {
      display: flex;
      align-items: center;
      gap: 36px;
      list-style: none;
    }
    .header-nav a {
      font-size: 13px;
      font-weight: 400;
      color: var(--color-muted);
      text-decoration: none;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      position: relative;
      padding-bottom: 3px;
      transition: color 0.2s;
    }
    .header-nav a::after {
      content: '';
      position: absolute;
      bottom: -1px;
      left: 0;
      width: 0;
      height: 1px;
      background: var(--color-gold);
      transition: width 0.25s ease;
    }
    .header-nav a:hover,
    .header-nav a.active {
      color: var(--color-text);
    }
    .header-nav a:hover::after,
    .header-nav a.active::after {
      width: 100%;
    }
    .header-nav a.active {
      color: var(--color-gold);
    }
    .header-actions {
      display: flex;
      align-items: center;
      gap: 14px;
      min-width: 200px;
      justify-content: flex-end;
    }
    .icon-btn {
      background: none;
      border: none;
      color: var(--color-muted);
      cursor: pointer;
      padding: 6px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: color 0.2s;
      line-height: 1;
    }
    .icon-btn:hover {
      color: var(--color-text);
    }
    .icon-btn .ti {
      font-size: 20px;
    }
    .header-divider {
      width: 1px;
      height: 20px;
      background: var(--color-border);
    }
    .btn-rdv {
      background: var(--bg-dark);
      color: #f0ebe4;
      border: none;
      padding: 11px 24px;
      font-family: var(--font-sans);
      font-size: 12px;
      font-weight: 400;
      letter-spacing: 0.14em;
      text-transform: uppercase;
      cursor: pointer;
      transition: background 0.2s;
      white-space: nowrap;
    }
    .btn-rdv:hover {
      background: var(--color-gold);
    }
    .header-subnav {
      border-top: 1px solid var(--color-border);
      padding: 0 48px;
      display: flex;
      gap: 0;
      overflow-x: auto;
      scrollbar-width: none;
    }
    .header-subnav::-webkit-scrollbar {
      display: none;
    }
    .subnav-item {
      font-size: 12px;
      color: var(--color-muted);
      letter-spacing: 0.06em;
      padding: 10px 20px;
      cursor: pointer;
      border-bottom: 2px solid transparent;
      transition: color 0.2s, border-color 0.2s;
      white-space: nowrap;
      display: flex;
      align-items: center;
      gap: 6px;
      text-decoration: none;
      background: none;
      border-left: none;
      border-right: none;
      border-top: none;
      font-family: var(--font-sans);
    }
    .subnav-item:first-child {
      padding-left: 0;
    }
    .subnav-item:hover {
      color: var(--color-text);
      border-bottom-color: var(--color-gold-lt);
    }
    .subnav-item.active {
      color: var(--color-gold);
      border-bottom-color: var(--color-gold);
    }
    .subnav-item .ti {
      font-size: 14px;
    }
    .burger-btn {
      display: none;
      background: none;
      border: none;
      color: var(--color-muted);
      cursor: pointer;
      padding: 6px;
    }
    .burger-btn .ti {
      font-size: 24px;
    }
    .mobile-nav {
      display: none;
      flex-direction: column;
      background: var(--bg-page);
      border-top: 1px solid var(--color-border);
      padding: 16px 24px 24px;
      gap: 4px;
    }
    .mobile-nav a {
      color: var(--color-muted);
      text-decoration: none;
      font-size: 14px;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      padding: 10px 0;
      border-bottom: 1px solid var(--color-border);
    }
    .mobile-nav a:last-child {
      border-bottom: none;
    }
    .mobile-nav .btn-rdv {
      margin-top: 16px;
      width: 100%;
      text-align: center;
    }
    @media (max-width: 900px) {
      .top-bar { padding: 7px 24px; }
      .header-main { padding: 0 24px; height: 72px; }
      .header-subnav { padding: 0 24px; }

      .header-nav,
      .header-actions .icon-btn,
      .header-divider,
      .header-subnav {
        display: none;
      }

      .burger-btn {
        display: flex;
      }

      .header-actions {
        min-width: unset;
        gap: 8px;
      }
    }

    @media (max-width: 600px) {
      .top-bar { display: none; }
      .salon-name-main { font-size: 22px; }
    }
  </style>
</head>

<body>
<header class="site-header">
  <div class="top-bar">
    <div class="top-bar-left">
      <i class="ti ti-map-pin" aria-hidden="true"></i>
      136 av Alan Turling
      <span class="sep">·</span>
      <i class="ti ti-clock" aria-hidden="true"></i>
      Lun–Sam : 9h–19h
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
        <span class="salon-name-sub"> On coupe vite, on coupe bien — même si vous fuyez !</span>
      </div>
    </a>
    <nav aria-label="Navigation principale">
      <ul class="header-nav">
        <li><a href="index.php" class="active">Accueil</a></li>
        <li><a href="reservation.php"></a>Reservation</li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </nav>
    <div class="header-actions">
      <button class="icon-btn" aria-label="Rechercher">
        <i class="ti ti-search" aria-hidden="true"></i>
      </button>
      <div class="header-divider" aria-hidden="true"></div>
      <a href="reservation.php" class="btn-rdv">Réserver</a>
      <button class="burger-btn" aria-label="Ouvrir le menu" aria-expanded="false" id="burgerBtn">
        <i class="ti ti-menu-2" aria-hidden="true"></i>
      </button>
    </div>

  </div>
  <nav class="header-subnav" aria-label="Catégories de prestations">
    <a href="reservation.php#coupe" class="subnav-item active">
      <i class="ti ti-scissors" aria-hidden="true"></i> Coupe &amp; Coiffage
    </a>
    <a href="reservation.php#couleur" class="subnav-item">
      <i class="ti ti-palette" aria-hidden="true"></i> Coloration
    </a>
    <a href="reservation.php#soins" class="subnav-item">
      <i class="ti ti-sparkles" aria-hidden="true"></i> Soins &amp; Traitements
    </a>
    <a href="reservation.php#mariages" class="subnav-item">
      <i class="ti ti-crown" aria-hidden="true"></i> Mariages &amp; Événements
    </a>
    <a href="index.php" class="subnav-item">
      <i class="ti ti-shopping-bag" aria-hidden="true"></i> Boutique
    </a>
  </nav>
  <nav class="mobile-nav" id="mobileNav" aria-label="Menu mobile">
    <a href="index.php">Accueil</a>
    <a href="contact.php">Contact</a>
    <a href="reservation.php" class="btn-rdv">Réserver un rendez-vous</a>
  </nav>

</header>
<script>
  const burgerBtn  = document.getElementById('burgerBtn');
  const mobileNav  = document.getElementById('mobileNav');

  burgerBtn.addEventListener('click', () => {
    const isOpen = mobileNav.style.display === 'flex';
    mobileNav.style.display  = isOpen ? 'none' : 'flex';
    burgerBtn.setAttribute('aria-expanded', String(!isOpen));
    burgerBtn.querySelector('.ti').className = isOpen
      ? 'ti ti-menu-2'
      : 'ti ti-x';
  });

  const currentPath = window.location.pathname.split('/').pop() || 'index.php';
  document.querySelectorAll('.header-nav a, .mobile-nav a').forEach(link => {
    const href = link.getAttribute('href');
    if (href === currentPath) {
      link.classList.add('active');
    } else {
      link.classList.remove('active');
    }
  });
</script>

</body>
</html>