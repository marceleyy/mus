<?php
session_start();

// Définition des identifiants d'administration
$admin_credentials = [
    'admin' => 'admin123',
    'directeur' => 'musee2025'
];

// Mot de passe spécial pour accéder à la billetterie
$special_password = 'billetterie2025';

$error_message = '';

// Traitement du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Vérification du mot de passe spécial pour la billetterie
    if ($password === $special_password) {
        header('Location: billetterie.php');
        exit;
    }

    // Vérification des identifiants d'administration
    if (isset($admin_credentials[$username]) && $admin_credentials[$username] === $password) {
        // Authentification réussie
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        
        // Redirection vers le tableau de bord
        header('Location: stat');
        exit;
    } else {
        $error_message = 'Identifiants incorrects. Veuillez réessayer.';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration | Musée des Lumières Évian</title>
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
                    <li><a href="login.php" class="active">Admin</a></li>
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
        <!-- Page Header -->
        <section class="page-header">
            <div class="container">
                <h1>Administration</h1>
                <p>Espace réservé au personnel du musée</p>
            </div>
        </section>

        <!-- Login Section -->
        <section class="login-section">
            <div class="container">
                <div class="login-container">
                    <div class="login-card">
                        <div class="login-header">
                            <div class="login-logo">
                                <span class="logo-text">Musée des Lumières</span>
                                <span class="logo-location">Évian</span>
                            </div>
                            <h2>Connexion</h2>
                            <p>Veuillez vous connecter pour accéder à l'espace d'administration</p>
                        </div>
                        
                        <?php if ($error_message): ?>
                            <div class="error-message">
                                <?php echo $error_message; ?>
                            </div>
                        <?php endif; ?>
                        
                        <form id="login-form" class="login-form" method="POST" action="login.php">
                            <div class="form-group">
                                <label for="username">Nom d'utilisateur</label>
                                <div class="input-icon">
                                    <i class="fas fa-user"></i>
                                    <input type="text" id="username" name="username" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password">Mot de passe</label>
                                <div class="input-icon">
                                    <i class="fas fa-lock"></i>
                                    <input type="password" id="password" name="password" required>
                                </div>
                            </div>
                            <div class="form-group checkbox">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">Se souvenir de moi</label>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn primary-btn">Se connecter</button>
                            </div>
                            <div class="login-help">
                                <a href="#" class="text-link">Mot de passe oublié ?</a>
                            </div>
                            <div class="login-note">
                                <p>Pour la démo, utilisez: <strong>admin / admin123</strong></p>
                            </div>
                        </form>
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