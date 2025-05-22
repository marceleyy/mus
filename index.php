<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musée des Lumières | Évian</title>
    <link rel="stylesheet" href="CSS/styles.css">
    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="logo">
                <a href="index.php">
                    <span class="logo-text">Musée des Lumières</span>
                    <span class="logo-location">Évian</span>
                </a>
            </div>
            <nav>
                <ul class="nav-links">
                    <li><a href="index.php" class="active">Accueil</a></li>
                    <li><a href="index.php">Expositions</a></li>
                    <li><a href="login.php">Admin</a></li>
                    <li><a href="billetterie.php">Billetterie</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
            <div class="nav-buttons">
                <button id="theme-toggle" aria-label="Changer de thème">
                    <i class="fas fa-moon"></i>
                </button>
                <div class="language-selector">
                    <span>FR</span>
                    <i class="fas fa-chevron-down"></i>
                    <div class="language-dropdown">
                        <a href="#" class="active">Français</a>
                        <a href="#">English</a>
                        <a href="#">Deutsch</a>
                    </div>
                </div>
                <div class="menu-btn">
                    <i class="fas fa-bars"></i>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <h1>Découvrez l'art <span class="highlight">en lumière</span></h1>
                <p>Une expérience immersive unique au cœur des Alpes</p>
                <div class="hero-buttons">
                    <a href="billetterie.php" class="btn primary-btn">Réserver des billets</a>
                    <a href="expositions.html" class="btn secondary-btn">Voir les expositions</a>
                </div>
            </div>
            <div class="hero-overlay"></div>
        </section>

        <!-- Current Exhibition -->
        <section class="current-exhibition">
            <div class="container">
                <div class="section-header">
                    <span class="section-subtitle">Exposition en cours</span>
                    <h2>Les Maîtres de l'Impressionnisme</h2>
                    <p class="exhibition-dates">15 Mai - 30 Septembre 2025</p>
                </div>
                <div class="exhibition-content">
                    <div class="exhibition-image">
                        <img src="https://via.placeholder.com/800x500" alt="Exposition Impressionnisme">
                    </div>
                    <div class="exhibition-text">
                        <p>Plongez dans l'univers coloré et lumineux des grands maîtres de l'impressionnisme. Cette exposition exceptionnelle rassemble plus de 100 œuvres de Monet, Renoir, Degas et d'autres artistes emblématiques du mouvement.</p>
                        <p>À travers un parcours immersif et des installations lumineuses innovantes, redécouvrez ces chefs-d'œuvre sous un jour nouveau.</p>
                        <div class="exhibition-cta">
                            <a href="expositions.html" class="btn text-btn">En savoir plus <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Museum Highlights -->
        <section class="museum-highlights">
            <div class="container">
                <div class="section-header centered">
                    <span class="section-subtitle">Découvrez</span>
                    <h2>Les points forts du musée</h2>
                </div>
                <div class="highlights-grid">
                    <div class="highlight-card">
                        <div class="highlight-icon">
                            <i class="fas fa-paint-brush"></i>
                        </div>
                        <h3>Collections permanentes</h3>
                        <p>Plus de 500 œuvres d'art du 19ème au 21ème siècle, mettant en valeur l'évolution de la lumière dans l'art.</p>
                    </div>
                    <div class="highlight-card">
                        <div class="highlight-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <h3>Expositions temporaires</h3>
                        <p>Des expositions thématiques renouvelées chaque trimestre, présentant des artistes internationaux.</p>
                    </div>
                    <div class="highlight-card">
                        <div class="highlight-icon">
                            <i class="fas fa-vr-cardboard"></i>
                        </div>
                        <h3>Expériences immersives</h3>
                        <p>Des installations interactives utilisant les dernières technologies pour une expérience sensorielle unique.</p>
                    </div>
                    <div class="highlight-card">
                        <div class="highlight-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>Ateliers créatifs</h3>
                        <p>Des ateliers pour tous les âges permettant d'explorer différentes techniques artistiques.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Upcoming Events -->
        <section class="upcoming-events">
            <div class="container">
                <div class="section-header">
                    <span class="section-subtitle">Agenda</span>
                    <h2>Événements à venir</h2>
                </div>
                <div class="events-slider">
                    <div class="event-card">
                        <div class="event-date">
                            <span class="day">12</span>
                            <span class="month">Juin</span>
                        </div>
                        <div class="event-content">
                            <h3>Nuit des Lumières</h3>
                            <p class="event-time"><i class="far fa-clock"></i> 19h00 - 23h00</p>
                            <p>Une soirée exceptionnelle où le musée s'illumine de mille feux avec des projections artistiques sur les façades.</p>
                            <a href="#" class="btn small-btn">Réserver</a>
                        </div>
                    </div>
                    <div class="event-card">
                        <div class="event-date">
                            <span class="day">25</span>
                            <span class="month">Juin</span>
                        </div>
                        <div class="event-content">
                            <h3>Atelier "Peindre la lumière"</h3>
                            <p class="event-time"><i class="far fa-clock"></i> 14h00 - 16h30</p>
                            <p>Apprenez les techniques des impressionnistes pour capturer la lumière dans vos peintures.</p>
                            <a href="#" class="btn small-btn">Réserver</a>
                        </div>
                    </div>
                    <div class="event-card">
                        <div class="event-date">
                            <span class="day">8</span>
                            <span class="month">Juil</span>
                        </div>
                        <div class="event-content">
                            <h3>Conférence: L'art et la science de la lumière</h3>
                            <p class="event-time"><i class="far fa-clock"></i> 18h30 - 20h00</p>
                            <p>Une exploration fascinante des liens entre l'art, la physique et la perception de la lumière.</p>
                            <a href="#" class="btn small-btn">Réserver</a>
                        </div>
                    </div>
                </div>
                <div class="events-navigation">
                    <button class="event-nav prev" aria-label="Événement précédent">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <div class="event-dots">
                        <span class="event-dot active"></span>
                        <span class="event-dot"></span>
                        <span class="event-dot"></span>
                    </div>
                    <button class="event-nav next" aria-label="Événement suivant">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </section>

        <!-- Visitor Info -->
        <section class="visitor-info">
            <div class="container">
                <div class="info-grid">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="far fa-clock"></i>
                        </div>
                        <h3>Horaires d'ouverture</h3>
                        <ul class="opening-hours">
                            <li><span>Lundi:</span> <span>Fermé</span></li>
                            <li><span>Mardi - Vendredi:</span> <span>10h00 - 18h00</span></li>
                            <li><span>Samedi - Dimanche:</span> <span>9h00 - 19h00</span></li>
                            <li><span>Jours fériés:</span> <span>10h00 - 17h00</span></li>
                        </ul>
                        <p class="info-note">Dernière entrée 1h avant la fermeture</p>
                    </div>
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <h3>Tarifs</h3>
                        <ul class="pricing">
                            <li><span>Adulte:</span> <span>15€</span></li>
                            <li><span>Enfant (6-18 ans):</span> <span>8€</span></li>
                            <li><span>Senior (65+):</span> <span>12€</span></li>
                            <li><span>Étudiant:</span> <span>10€</span></li>
                            <li><span>Famille (2 adultes + 2 enfants):</span> <span>38€</span></li>
                        </ul>
                        <p class="info-note">Entrée gratuite le premier dimanche du mois</p>
                    </div>
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3>Adresse</h3>
                        <address>
                            Musée des Lumières<br>
                            15 Quai Charles-Albert Besson<br>
                            74500 Évian-les-Bains<br>
                            France
                        </address>
                        <p class="directions-link">
                            <a href="#" class="text-link">Comment venir <i class="fas fa-external-link-alt"></i></a>
                        </p>
                    </div>
                </div>
                <div class="cta-banner">
                    <h3>Prêt à vivre l'expérience ?</h3>
                    <p>Réservez vos billets en ligne et évitez les files d'attente</p>
                    <a href="billetterie.php" class="btn primary-btn">Réserver maintenant</a>
                </div>
            </div>
        </section>

        <!-- Newsletter -->
        <section class="newsletter">
            <div class="container">
                <div class="newsletter-content">
                    <div class="newsletter-text">
                        <h2>Restez informé</h2>
                        <p>Inscrivez-vous à notre newsletter pour recevoir les dernières actualités du musée, les invitations aux vernissages et des offres exclusives.</p>
                    </div>
                    <form class="newsletter-form">
                        <div class="form-group">
                            <input type="email" placeholder="Votre adresse email" required>
                            <button type="submit" class="btn primary-btn">S'inscrire</button>
                        </div>
                        <div class="form-consent">
                            <input type="checkbox" id="consent" required>
                            <label for="consent">J'accepte de recevoir des informations du Musée des Lumières</label>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-about">
                    <div class="footer-logo">
                        <span class="logo-text">Musée des Lumières</span>
                        <span class="logo-location">Évian</span>
                    </div>
                    <p>Un espace dédié à l'art et à la lumière, offrant une expérience immersive unique au cœur des Alpes françaises.</p>
                    <div class="social-links">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="footer-links">
                    <h3>Liens rapides</h3>
                    <ul>
                        <li><a href="musee.php">Accueil</a></li>
                        <li><a href="expositions.html">Expositions</a></li>
                        <li><a href="visiter.html">Visiter</a></li>
                        <li><a href="billetterie.php">Billetterie</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h3>Informations</h3>
                    <ul>
                        <li><a href="#">Accessibilité</a></li>
                        <li><a href="#">Groupes et scolaires</a></li>
                        <li><a href="#">Mécénat et partenariats</a></li>
                        <li><a href="#">Espace presse</a></li>
                        <li><a href="#">Recrutement</a></li>
                    </ul>
                </div>
                <div class="footer-contact">
                    <h3>Contact</h3>
                    <ul>
                        <li><i class="fas fa-map-marker-alt"></i> 15 Quai Charles-Albert Besson, 74500 Évian</li>
                        <li><i class="fas fa-phone"></i> +33 (0)4 50 75 XX XX</li>
                        <li><i class="fas fa-envelope"></i> contact@museedeslumieres.fr</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <span id="current-year"></span> Musée des Lumières. Tous droits réservés.</p>
                <div class="footer-legal">
                    <a href="#">Mentions légales</a>
                    <a href="#">Politique de confidentialité</a>
                    <a href="#">Conditions générales</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="JS/script.js"></script>
</body>
</html>