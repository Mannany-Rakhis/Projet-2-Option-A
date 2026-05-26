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
<?php include 'includes/header.php'; ?>

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
    .main-info {
        display: flex;
        flex-direction: column;
        justify-content: space-around;

    }

    .main-info {
    display: flex;
    flex-direction: row;
    gap: 20px;
    align-items: flex-start;
    padding: 200px;
    }

    .main-info-left {
    display: flex;
    flex-direction: column;
    gap: 24px;
    flex: 1;
    }

    .map {
    flex: 1;
    padding: 200px;
    }

    .titre {
        display: flex;
        flex-direction: row;
        justify-content: center;
    }
  </style>
</head>

<body>
    <main>
        
        <div class="main-info">
            <div class="main-info-left">
                <div class="titre">
                <h1>Nous contacter</h1>
                </div>
                
                <div class="adresse">
                    <div class="adresse-content">
                        <h4>Adresse</h4>
                        <address>
                            <p>136 Av. Alan Turing</p>
                            <p>59410 Anzin</p>
                        </address>
                    </div>
                </div>

                <div class="horaire">
                    <h4>Horaires d'ouverture</h4>
                </div>
                    <div class="horaire-semaine">
                        <span>Lundi - Fermé <BR></span>
                        <span>Mardi - 9h00 - 19h00 <BR></span>
                        <span>Mercredi - 9h00 - 19h00 <BR></span>
                        <span>Jeudi - 9h00 - 19h00 <BR></span>
                        <span>Vendredi - 9h00 - 19h00 <BR></span>
                        <span>Samedi - 9h00 - 19h00 <BR></span>
                        <span>Dimanche - 9h00 - 19h00 <BR></span>
                    </div>
                
                <div class="telephone">
                    <div class="telephone-content">
                        <h4>Téléphone</h4>
                        <p><a href="tel:+33327000000">03 27 00 00 00</a></p>
                    </div>
                </div>

                <div class="email">
                    <div class="email-content">
                        <h4>Email</h4>
                        <p><a href="mailto:">contact@chauve-qui-peut.fr/a></p>
                    </div>
                </div>
            </div>
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2544.6901503235304!2d3.517362976752171!3d50.37233187157732!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c2eddbd69aa3c7%3A0x4c820465e05a0851!2s130%20Av.%20Alan%20Turing%2C%2059410%20Anzin!5e0!3m2!1sen!2sfr!4v1779626359865!5m2!1sen!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </main>
</body>
<?php include 'includes/footer.php'; ?>

    