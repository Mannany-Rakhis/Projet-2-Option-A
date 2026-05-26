<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>salon de coiffure</title>
    <link rel="stylesheet" href="homepage.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
        <main>
             <!-- partie Hero -->
            <section class="hero">
                <div class="hero-tag">
                    <p class="hero-eyebrow">coiffure · soins · Manucure </p>
                </div>
                <h1 class="hero-title">
                    ChauffeQUIPEUT Réservez en beauté
                <h1>    
                <p class="hero-subtitle">Trouvez votre salon, prenez rendez-vous en ligne, confirmé immédiatement.</p>
                <div class="hero-actions">  
                     <a href="reservation.html" class="btn-primary">Réserver une coupe</a>   
                     <a href="menu.html" class="btn-ghost">Découvrir nos coupes</a> 
                </div>                 
            </section>

             <!-- partie histoire -->
            <section class="slider-section">
                <div class="slider-track">
                    <div class="slide-card">
                    <img src="https://res.cloudinary.com/planity/image/upload/f_auto,q_auto/v1701273308/portail/illustrations/HOMEPAGE/MAIN_2023/SLIDER/hair_care.jpg" alt="Coiffeur" />
                    <div class="slide-label">Coiffeur</div>
                    </div>
                    <div class="slide-card">
                    <img src="https://res.cloudinary.com/planity/image/upload/f_auto,q_auto/v1701273308/portail/illustrations/HOMEPAGE/MAIN_2023/SLIDER/barber_shop.jpg" alt="Barbier" />
                    <div class="slide-label">Barbier</div>
                    </div>
                    <div class="slide-card">
                    <img src="https://res.cloudinary.com/planity/image/upload/f_auto,q_auto/v1701273308/portail/illustrations/HOMEPAGE/MAIN_2023/SLIDER/nails.jpg" alt="Manucure" />
                    <div class="slide-label">Manucure</div>
                    </div>
                    <div class="slide-card">
                    <img src="https://res.cloudinary.com/planity/image/upload/f_auto,q_auto/v1701273308/portail/illustrations/HOMEPAGE/MAIN_2023/SLIDER/beauty_salon.jpg" alt="Institut de beauté" />
                    <div class="slide-label">Institut de beauté</div>
                    </div>
                </div>
            </section>

             <!-- avis -->
            <section class="avis-section" id="avis">
                  <div class="avis-header reveal">
                       <p class="section-label">Ce qu'ils disent</p>
                       <h2 class="section-title" style="color:var(--white)">Nos clients<br><em>témoignent</em></h2>
                       <div class="divider center" style="background:rgba(201,168,76,0.4)"></div>
                  </div>
                  <div class="avis-track-outer reveal">
                       <div class="avis-track" id="avisTrack"> 
                          <!-- Cards doubled for seamless loop -->
                       </div>
                  </div>
            </section> 
            <!--présentation produit-->

        </main>
</body>
<script>
        /* ─── Avis carousel ─── */
        
    const avis = [
      { text: "Un accueil chaleureux et un savoir-faire remarquable. La coupe était parfaite, et l’équipe d’une gentillesse exemplaire.", author: "Marie-Claire D.", stars: 5 },
      { text: "Moment agréable au salon. L’équipe a été aux petits soins du début à la fin, une prestation de grande qualité. J’y retournerai avec plaisir.", author: "Thomas & Julie", stars: 5 },
      { text: "Un salon incontournable. L’ambiance chaleureuse, la décoration soignée et le professionnalisme de l’équipe… c’est exactement ce qu’on attend d’un excellent salon de coiffure..", author: "Bernard L.", stars: 5 },
      { text: "L’équipe a su accueillir tout le monde avec professionnalisme et efficacité, le tout avec un excellent rapport qualité-prix. Merci à toute l’équipe !", author: "Sylvie M.", stars: 5 },
      { text: "Enfin un salon où l’on prend vraiment le temps de s’occuper de ses clients. Chaque prestation est réalisée avec soin et l’ambiance est au top, Une vraie pépite.", author: "Antoine R.", stars: 5 },
    ];
 
    const track = document.getElementById('avisTrack');
    const allAvis = [...avis, ...avis]; // double pour boucle infinie
 
    allAvis.forEach(a => {
      const card = document.createElement('div');
      card.className = 'avis-card';
      card.innerHTML = `
        <div class="stars">${'★'.repeat(a.stars)}${'☆'.repeat(5 - a.stars)}</div>
        <p class="avis-text">"${a.text}"</p>
        <p class="avis-author">${a.author}</p>
      `;
      track.appendChild(card);
    });
 
</script>
</html>