<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | Musée des Lumières | Évian</title>
    <link rel="stylesheet" href="css/styles.css">
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
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="index.php">Expositions</a></li>
                    <li><a href="login.php">Admin</a></li>
                    <li><a href="billetterie.php">Billetterie</a></li>
                    <li><a href="contact.php" class="active">Contact</a></li>
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
        <!-- Page Header -->
        <section class="page-header">
            <div class="container">
                <h1>Contactez-nous</h1>
                <p>Nous sommes à votre écoute pour toute question ou demande d'information</p>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="contact-section">
            <div class="container">
                <div class="section-header">
                    <span class="section-subtitle">Nous contacter</span>
                    <h2>Comment pouvons-nous vous aider ?</h2>
                </div>
                
                <div class="contact-grid">
                    <!-- Contact Form -->
                    <div class="contact-form-container">
                        <h3>Envoyez-nous un message</h3>
                        <form class="contact-form">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="name">Nom complet</label>
                                    <input type="text" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Adresse email</label>
                                    <input type="email" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="phone">Téléphone</label>
                                    <input type="tel" id="phone" name="phone">
                                </div>
                                <div class="form-group">
                                    <label for="subject">Sujet</label>
                                    <select id="subject" name="subject" required>
                                        <option value="" disabled selected>Choisissez un sujet</option>
                                        <option value="information">Demande d'information</option>
                                        <option value="reservation">Réservation de groupe</option>
                                        <option value="partnership">Partenariat</option>
                                        <option value="feedback">Commentaires</option>
                                        <option value="other">Autre</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea id="message" name="message" rows="6" required></textarea>
                            </div>
                            <div class="form-group checkbox">
                                <input type="checkbox" id="consent" name="consent" required>
                                <label for="consent">J'accepte que mes données soient traitées conformément à la politique de confidentialité du Musée des Lumières</label>
                            </div>
                            <button type="submit" class="btn primary-btn">Envoyer le message</button>
                        </form>
                    </div>
                    
                    <!-- Contact Info -->
                    <div class="contact-info-container">
                        <div class="contact-info-card">
                            <h3>Informations de contact</h3>
                            <div class="contact-options">
                                <div class="contact-option">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <div>
                                        <strong>Adresse</strong>
                                        <p>15 Quai Charles-Albert Besson<br>74500 Évian-les-Bains<br>France</p>
                                    </div>
                                </div>
                                <div class="contact-option">
                                    <i class="fas fa-phone"></i>
                                    <div>
                                        <strong>Téléphone</strong>
                                        <p>+33 (0)4 50 75 XX XX</p>
                                    </div>
                                </div>
                                <div class="contact-option">
                                    <i class="fas fa-envelope"></i>
                                    <div>
                                        <strong>Email</strong>
                                        <p>contact@museedeslumieres.fr</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="opening-hours-container">
                                <h4>Horaires d'ouverture</h4>
                                <ul class="opening-hours">
                                    <li><span>Lundi:</span> <span>Fermé</span></li>
                                    <li><span>Mardi - Vendredi:</span> <span>10h00 - 18h00</span></li>
                                    <li><span>Samedi - Dimanche:</span> <span>9h00 - 19h00</span></li>
                                    <li><span>Jours fériés:</span> <span>10h00 - 17h00</span></li>
                                </ul>
                            </div>
                            
                            <div class="social-links-container">
                                <h4>Suivez-nous</h4>
                                <div class="social-links">
                                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                                    <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Map Section -->
        <section class="map-section">
            <div class="container">
                <div class="section-header centered">
                    <span class="section-subtitle">Localisation</span>
                    <h2>Comment nous trouver</h2>
                </div>
                <div class="map-container">
                    <!-- Remplacez l'URL par votre iframe Google Maps -->
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2758.4664254533726!2d6.584731076938837!3d46.40089997111982!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478c3e8eaae2172b%3A0x408ab2ae4baa830!2sQuai%20Charles-Albert%20Besson%2C%2074500%20%C3%89vian-les-Bains!5e0!3m2!1sfr!2sfr!4v1712748000000!5m2!1sfr!2sfr" width="100%" height="450" style="border:0; border-radius: var(--radius);" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                
                <div class="directions-container">
                    <div class="highlights-grid">
                        <div class="highlight-card">
                            <div class="highlight-icon">
                                <i class="fas fa-car"></i>
                            </div>
                            <h3>En voiture</h3>
                            <p>Parking public à proximité du musée. Suivez les indications pour le centre-ville d'Évian.</p>
                        </div>
                        <div class="highlight-card">
                            <div class="highlight-icon">
                                <i class="fas fa-train"></i>
                            </div>
                            <h3>En train</h3>
                            <p>Gare SNCF d'Évian-les-Bains à 10 minutes à pied du musée.</p>
                        </div>
                        <div class="highlight-card">
                            <div class="highlight-icon">
                                <i class="fas fa-ship"></i>
                            </div>
                            <h3>En bateau</h3>
                            <p>Traversée depuis Lausanne (Suisse) par la CGN. Débarcadère à 5 minutes à pied.</p>
                        </div>
                        <div class="highlight-card">
                            <div class="highlight-icon">
                                <i class="fas fa-bus"></i>
                            </div>
                            <h3>En bus</h3>
                            <p>Lignes urbaines et interurbaines. Arrêt "Centre-ville" à proximité du musée.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- FAQ Section -->
        <section class="faq-section">
            <div class="container">
                <div class="section-header centered">
                    <span class="section-subtitle">Questions fréquentes</span>
                    <h2>Besoin d'aide ?</h2>
                </div>
                
                <div class="faq-container">
                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>Comment réserver des billets pour un groupe ?</h3>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>Pour les groupes de 10 personnes ou plus, veuillez nous contacter par téléphone au +33 (0)4 50 75 XX XX ou par email à groupes@museedeslumieres.fr au moins 2 semaines à l'avance. Nous proposons des tarifs spéciaux et des visites guidées pour les groupes.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>Le musée est-il accessible aux personnes à mobilité réduite ?</h3>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>Oui, le Musée des Lumières est entièrement accessible aux personnes à mobilité réduite. Des fauteuils roulants sont disponibles gratuitement à l'accueil (réservation recommandée). Des places de parking réservées sont situées à proximité de l'entrée principale.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>Peut-on prendre des photos dans le musée ?</h3>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>La photographie sans flash est autorisée dans les collections permanentes pour un usage personnel. Certaines expositions temporaires peuvent faire l'objet de restrictions. Les selfie-sticks, trépieds et perches à selfie ne sont pas autorisés.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>Y a-t-il un vestiaire pour déposer mes affaires ?</h3>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>Oui, un vestiaire gratuit est disponible à l'entrée du musée. Les grands sacs, parapluies et manteaux doivent y être déposés. Des casiers sécurisés sont également disponibles pour les objets de valeur.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>Le musée dispose-t-il d'un café ou d'un restaurant ?</h3>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>Oui, le Café des Lumières situé au 2ème étage propose une sélection de boissons, pâtisseries et plats légers. Une terrasse avec vue sur le lac est ouverte pendant la saison estivale. Horaires : 10h00 - 17h30 (fermé le lundi).</p>
                        </div>
                    </div>
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
                            <input type="checkbox" id="newsletter-consent" required>
                            <label for="newsletter-consent">J'accepte de recevoir des informations du Musée des Lumières</label>
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
    <script>
        // Script pour les FAQ accordéon
        document.addEventListener('DOMContentLoaded', function() {
            const faqItems = document.querySelectorAll('.faq-item');
            
            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question');
                const answer = item.querySelector('.faq-answer');
                const icon = question.querySelector('i');
                
                // Initialiser les réponses comme fermées
                answer.style.display = 'none';
                
                question.addEventListener('click', () => {
                    // Toggle la réponse
                    if (answer.style.display === 'none') {
                        answer.style.display = 'block';
                        icon.classList.remove('fa-chevron-down');
                        icon.classList.add('fa-chevron-up');
                        item.classList.add('active');
                    } else {
                        answer.style.display = 'none';
                        icon.classList.remove('fa-chevron-up');
                        icon.classList.add('fa-chevron-down');
                        item.classList.remove('active');
                    }
                });
            });
            
            // Mettre à jour l'année dans le footer
            document.getElementById('current-year').textContent = new Date().getFullYear();
        });
    </script>
</body>
</html>