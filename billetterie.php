<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billetterie | Musée des Lumières Évian</title>
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
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="index.php">Expositions</a></li>
                    <li><a href="login.php">Admin</a></li>
                    <li><a href="billetterie.php" class="active">Billetterie</a></li>
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
        <!-- Page Header -->
        <section class="page-header">
            <div class="container">
                <h1>Billetterie</h1>
                <p>Réservez vos billets en ligne et préparez votre visite</p>
            </div>
        </section>

        <!-- Ticket Booking -->
        <section class="ticket-booking">
            <div class="container">
                <div class="booking-container">
                    <!-- Booking Steps -->
                    <div class="booking-steps">
                        <div class="step active" data-step="1">
                            <div class="step-number">1</div>
                            <div class="step-text">Date</div>
                        </div>
                        <div class="step-connector"></div>
                        <div class="step" data-step="2">
                            <div class="step-number">2</div>
                            <div class="step-text">Billets</div>
                        </div>
                        <div class="step-connector"></div>
                        <div class="step" data-step="3">
                            <div class="step-number">3</div>
                            <div class="step-text">Options</div>
                        </div>
                        <div class="step-connector"></div>
                        <div class="step" data-step="4">
                            <div class="step-number">4</div>
                            <div class="step-text">Coordonnées</div>
                        </div>
                        <div class="step-connector"></div>
                        <div class="step" data-step="5">
                            <div class="step-number">5</div>
                            <div class="step-text">Paiement</div>
                        </div>
                    </div>

                    <!-- Booking Form -->
                    <div class="booking-form">
                        <!-- Step 1: Date Selection -->
                        <div class="booking-step-content active" id="step-1">
                            <h2>Choisissez une date de visite</h2>
                            <div class="date-picker">
                                <div class="month-selector">
                                    <button class="month-nav prev" aria-label="Mois précédent">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <h3 id="current-month">Juin 2025</h3>
                                    <button class="month-nav next" aria-label="Mois suivant">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                                <div class="calendar">
                                    <div class="weekdays">
                                        <div>Lun</div>
                                        <div>Mar</div>
                                        <div>Mer</div>
                                        <div>Jeu</div>
                                        <div>Ven</div>
                                        <div>Sam</div>
                                        <div>Dim</div>
                                    </div>
                                    <div class="days">
                                        <div class="day disabled">29</div>
                                        <div class="day disabled">30</div>
                                        <div class="day disabled">31</div>
                                        <div class="day">1</div>
                                        <div class="day">2</div>
                                        <div class="day">3</div>
                                        <div class="day">4</div>
                                        <div class="day">5</div>
                                        <div class="day">6</div>
                                        <div class="day">7</div>
                                        <div class="day">8</div>
                                        <div class="day">9</div>
                                        <div class="day">10</div>
                                        <div class="day">11</div>
                                        <div class="day">12</div>
                                        <div class="day">13</div>
                                        <div class="day">14</div>
                                        <div class="day selected">15</div>
                                        <div class="day">16</div>
                                        <div class="day">17</div>
                                        <div class="day">18</div>
                                        <div class="day">19</div>
                                        <div class="day">20</div>
                                        <div class="day">21</div>
                                        <div class="day">22</div>
                                        <div class="day">23</div>
                                        <div class="day">24</div>
                                        <div class="day">25</div>
                                        <div class="day">26</div>
                                        <div class="day">27</div>
                                        <div class="day">28</div>
                                        <div class="day">29</div>
                                        <div class="day">30</div>
                                        <div class="day disabled">1</div>
                                        <div class="day disabled">2</div>
                                    </div>
                                </div>
                                <div class="time-slots">
                                    <h4>Horaires disponibles pour le 15 Juin 2025</h4>
                                    <div class="slots">
                                        <div class="time-slot">10:00</div>
                                        <div class="time-slot">11:00</div>
                                        <div class="time-slot selected">14:00</div>
                                        <div class="time-slot">15:00</div>
                                        <div class="time-slot">16:00</div>
                                        <div class="time-slot">17:00</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button class="btn primary-btn next-step">Continuer</button>
                            </div>
                        </div>

                        <!-- Step 2: Ticket Selection -->
                        <div class="booking-step-content" id="step-2">
                            <h2>Sélectionnez vos billets</h2>
                            <div class="ticket-selection">
                                <div class="ticket-type">
                                    <div class="ticket-info">
                                        <h3>Adulte</h3>
                                        <p>18 ans et plus</p>
                                        <span class="ticket-price">15€</span>
                                    </div>
                                    <div class="ticket-quantity">
                                        <button class="quantity-btn minus" aria-label="Réduire la quantité">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="number" value="2" min="0" max="10" class="quantity-input" data-price="15">
                                        <button class="quantity-btn plus" aria-label="Augmenter la quantité">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="ticket-type">
                                    <div class="ticket-info">
                                        <h3>Enfant</h3>
                                        <p>6 à 17 ans</p>
                                        <span class="ticket-price">8€</span>
                                    </div>
                                    <div class="ticket-quantity">
                                        <button class="quantity-btn minus" aria-label="Réduire la quantité">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="number" value="1" min="0" max="10" class="quantity-input" data-price="8">
                                        <button class="quantity-btn plus" aria-label="Augmenter la quantité">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="ticket-type">
                                    <div class="ticket-info">
                                        <h3>Senior</h3>
                                        <p>65 ans et plus</p>
                                        <span class="ticket-price">12€</span>
                                    </div>
                                    <div class="ticket-quantity">
                                        <button class="quantity-btn minus" aria-label="Réduire la quantité">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="number" value="0" min="0" max="10" class="quantity-input" data-price="12">
                                        <button class="quantity-btn plus" aria-label="Augmenter la quantité">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="ticket-type">
                                    <div class="ticket-info">
                                        <h3>Étudiant</h3>
                                        <p>Sur présentation d'un justificatif</p>
                                        <span class="ticket-price">10€</span>
                                    </div>
                                    <div class="ticket-quantity">
                                        <button class="quantity-btn minus" aria-label="Réduire la quantité">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="number" value="0" min="0" max="10" class="quantity-input" data-price="10">
                                        <button class="quantity-btn plus" aria-label="Augmenter la quantité">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="ticket-type family-pack">
                                    <div class="ticket-info">
                                        <h3>Pack Famille</h3>
                                        <p>2 adultes + 2 enfants</p>
                                        <span class="ticket-price">38€</span>
                                        <span class="discount-badge">Économisez 8€</span>
                                    </div>
                                    <div class="ticket-quantity">
                                        <button class="quantity-btn minus" aria-label="Réduire la quantité">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="number" value="0" min="0" max="5" class="quantity-input" data-price="38">
                                        <button class="quantity-btn plus" aria-label="Augmenter la quantité">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button class="btn secondary-btn prev-step">Retour</button>
                                <button class="btn primary-btn next-step">Continuer</button>
                            </div>
                        </div>

                        <!-- Step 3: Options -->
                        <div class="booking-step-content" id="step-3">
                            <h2>Ajoutez des options</h2>
                            <div class="options-selection">
                                <div class="option-item">
                                    <div class="option-info">
                                        <h3>Audioguide</h3>
                                        <p>Découvrez l'exposition avec des commentaires audio détaillés</p>
                                        <span class="option-price">5€ par personne</span>
                                    </div>
                                    <div class="option-controls">
                                        <label class="switch">
                                            <input type="checkbox" class="option-toggle" data-price="5">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="option-item">
                                    <div class="option-info">
                                        <h3>Visite guidée</h3>
                                        <p>Visite d'1h30 avec un guide expert (groupes de 15 personnes max)</p>
                                        <span class="option-price">8€ par personne</span>
                                    </div>
                                    <div class="option-controls">
                                        <label class="switch">
                                            <input type="checkbox" class="option-toggle" data-price="8">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="option-item">
                                    <div class="option-info">
                                        <h3>Catalogue de l'exposition</h3>
                                        <p>Un beau livre illustré présentant les œuvres de l'exposition</p>
                                        <span class="option-price">25€</span>
                                    </div>
                                    <div class="option-controls">
                                        <label class="switch">
                                            <input type="checkbox" class="option-toggle" data-price="25">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="option-item">
                                    <div class="option-info">
                                        <h3>Atelier créatif</h3>
                                        <p>Participez à un atelier artistique après votre visite (durée: 1h)</p>
                                        <span class="option-price">12€ par personne</span>
                                    </div>
                                    <div class="option-controls">
                                        <label class="switch">
                                            <input type="checkbox" class="option-toggle" data-price="12">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button class="btn secondary-btn prev-step">Retour</button>
                                <button class="btn primary-btn next-step">Continuer</button>
                            </div>
                        </div>

                        <!-- Step 4: Contact Information -->
                        <div class="booking-step-content" id="step-4">
                            <h2>Vos coordonnées</h2>
                            <form class="contact-form">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="firstname">Prénom</label>
                                        <input type="text" id="firstname" name="firstname" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname">Nom</label>
                                        <input type="text" id="lastname" name="lastname" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Téléphone</label>
                                        <input type="tel" id="phone" name="phone" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address">Adresse</label>
                                    <input type="text" id="address" name="address">
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="postal">Code postal</label>
                                        <input type="text" id="postal" name="postal">
                                    </div>
                                    <div class="form-group">
                                        <label for="city">Ville</label>
                                        <input type="text" id="city" name="city">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="country">Pays</label>
                                    <select id="country" name="country">
                                        <option value="FR" selected>France</option>
                                        <option value="CH">Suisse</option>
                                        <option value="BE">Belgique</option>
                                        <option value="DE">Allemagne</option>
                                        <option value="IT">Italie</option>
                                        <option value="UK">Royaume-Uni</option>
                                        <option value="ES">Espagne</option>
                                        <option value="OTHER">Autre</option>
                                    </select>
                                </div>
                                <div class="form-group checkbox">
                                    <input type="checkbox" id="newsletter" name="newsletter">
                                    <label for="newsletter">Je souhaite recevoir la newsletter du musée</label>
                                </div>
                                <div class="form-group checkbox">
                                    <input type="checkbox" id="terms" name="terms" required>
                                    <label for="terms">J'accepte les <a href="#" class="text-link">conditions générales de vente</a></label>
                                </div>
                            </form>
                            <div class="form-actions">
                                <button class="btn secondary-btn prev-step">Retour</button>
                                <button class="btn primary-btn next-step">Continuer</button>
                            </div>
                        </div>

                        <!-- Step 5: Payment -->
                        <div class="booking-step-content" id="step-5">
                            <h2>Récapitulatif et paiement</h2>
                            <div class="order-summary">
                                <h3>Votre commande</h3>
                                <div class="summary-details">
                                    <div class="summary-item">
                                        <span class="summary-label">Date de visite:</span>
                                        <span class="summary-value">15 Juin 2025, 14:00</span>
                                    </div>
                                    <div class="summary-item">
                                        <span class="summary-label">Billets:</span>
                                        <div class="summary-tickets">
                                            <div class="summary-ticket">
                                                <span>2 × Adulte</span>
                                                <span>30€</span>
                                            </div>
                                            <div class="summary-ticket">
                                                <span>1 × Enfant</span>
                                                <span>8€</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="summary-item">
                                        <span class="summary-label">Options:</span>
                                        <div class="summary-options">
                                            <div class="summary-option">
                                                <span>3 × Audioguide</span>
                                                <span>15€</span>
                                            </div>
                                            <div class="summary-option">
                                                <span>1 × Catalogue</span>
                                                <span>25€</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="summary-total">
                                    <span class="total-label">Total:</span>
                                    <span class="total-value">78€</span>
                                </div>
                            </div>
                            <div class="payment-methods">
                                <h3>Mode de paiement</h3>
                                <div class="payment-options">
                                    <div class="payment-option">
                                        <input type="radio" id="card" name="payment" checked>
                                        <label for="card">
                                            <i class="far fa-credit-card"></i>
                                            Carte bancaire
                                        </label>
                                    </div>
                                    <div class="payment-option">
                                        <input type="radio" id="paypal" name="payment">
                                        <label for="paypal">
                                            <i class="fab fa-paypal"></i>
                                            PayPal
                                        </label>
                                    </div>
                                </div>
                                <div class="card-details">
                                    <div class="form-group">
                                        <label for="card-number">Numéro de carte</label>
                                        <input type="text" id="card-number" placeholder="1234 5678 9012 3456">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label for="expiry">Date d'expiration</label>
                                            <input type="text" id="expiry" placeholder="MM/AA">
                                        </div>
                                        <div class="form-group">
                                            <label for="cvv">CVV</label>
                                            <input type="text" id="cvv" placeholder="123">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="card-name">Nom sur la carte</label>
                                        <input type="text" id="card-name">
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button class="btn secondary-btn prev-step">Retour</button>
                                <button class="btn primary-btn" id="complete-purchase">Confirmer et payer</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Booking Info Sidebar -->
                <div class="booking-info">
                    <div class="info-card">
                        <h3>Informations pratiques</h3>
                        <ul class="info-list">
                            <li>
                                <i class="fas fa-info-circle"></i>
                                <span>Les billets sont valables uniquement pour la date et l'heure sélectionnées.</span>
                            </li>
                            <li>
                                <i class="fas fa-info-circle"></i>
                                <span>Présentez votre billet électronique à l'entrée (imprimé ou sur smartphone).</span>
                            </li>
                            <li>
                                <i class="fas fa-info-circle"></i>
                                <span>L'entrée est gratuite pour les enfants de moins de 6 ans.</span>
                            </li>
                            <li>
                                <i class="fas fa-info-circle"></i>
                                <span>Des tarifs réduits sont disponibles sur présentation d'un justificatif.</span>
                            </li>
                        </ul>
                    </div>
                    <div class="info-card">
                        <h3>Besoin d'aide ?</h3>
                        <p>Notre équipe est disponible pour répondre à vos questions.</p>
                        <div class="contact-options">
                            <a href="tel:+33450751234" class="contact-option">
                                <i class="fas fa-phone"></i>
                                <span>+33 (0)4 50 75 XX XX</span>
                            </a>
                            <a href="mailto:billetterie@museedeslumieres.fr" class="contact-option">
                                <i class="fas fa-envelope"></i>
                                <span>billetterie@museedeslumieres.fr</span>
                            </a>
                        </div>
                    </div>
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
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="expositions.html">Expositions</a></li>
                        <li><a href="visiter.html">Visiter</a></li>
                        <li><a href="billetterie.html">Billetterie</a></li>
                        <li><a href="contact.php">Contact</a></li>
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