<?php
session_start();

// Vérification de l'authentification
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Récupération du nom d'utilisateur
$username = isset($_SESSION['admin_username']) ? $_SESSION['admin_username'] : 'Administrateur';

// Connexion à SQLite pour les statistiques réelles
function dbconnect()
{
    try {
        $bdd = new PDO('sqlite:' . __DIR__ . '/sql/ProjetM.db');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        die('Erreur de connexion : ' . $e->getMessage());
    }
    return $bdd;
}

// Essayer de se connecter à la base de données
try {
    $bdd = dbconnect();
    $db_connected = true;
    
    // Nombre de visiteurs actuellement dans le musée
    $actuels = $bdd->query("SELECT COUNT(*) AS total FROM Visiteur WHERE Heure_Depart IS NULL")->fetch();
    
    // Nombre total de visiteurs aujourd'hui
    $aujourdhui = $bdd->query("SELECT COUNT(*) AS total FROM Visiteur WHERE Date = date('now')")->fetch();
    
    // Statistiques des expositions
    $stats_expos = $bdd->query("
        SELECT e.Libelle, COUNT(v.ID_Visiteur) AS nombre_visiteurs
        FROM Visite v
        JOIN Exposition e ON v.ID_Exposition = e.ID
        GROUP BY e.ID
    ")->fetchAll(PDO::FETCH_ASSOC);
    
    // Statistiques des types d'entrée
    $stats_types = $bdd->query("
        SELECT t.Libelle, COUNT(v.ID) AS nombre_visiteurs
        FROM Visiteur v
        JOIN Type_Entree t ON v.ID_Type_Entree = t.ID
        GROUP BY t.ID
    ")->fetchAll(PDO::FETCH_ASSOC);
    
    // Convertir les données pour les graphiques
    $ticket_types = [];
    foreach ($stats_types as $type) {
        $ticket_types[$type['Libelle']] = $type['nombre_visiteurs'];
    }
    
    // Données pour le graphique des réservations par jour (simulées pour la démo)
    $booking_dates = [
        'Lundi' => 520,
        'Mardi' => 680,
        'Mercredi' => 750,
        'Jeudi' => 620,
        'Vendredi' => 890,
        'Samedi' => 1250,
        'Dimanche' => 980
    ];
    
} catch (Exception $e) {
    // En cas d'erreur de connexion, utiliser des données simulées
    $db_connected = false;
    
    // Données statistiques simulées
    $stats = [
        'total_tickets' => 12458,
        'total_revenue' => 187450,
        'total_visitors' => 15320,
        'total_bookings' => 4256
    ];
    
    // Données pour le graphique des types de billets
    $ticket_types = [
        'Adulte' => 6230,
        'Enfant' => 3120,
        'Senior' => 1560,
        'Étudiant' => 1040,
        'Pack Famille' => 508
    ];
    
    // Données pour le graphique des réservations par jour
    $booking_dates = [
        'Lundi' => 520,
        'Mardi' => 680,
        'Mercredi' => 750,
        'Jeudi' => 620,
        'Vendredi' => 890,
        'Samedi' => 1250,
        'Dimanche' => 980
    ];
}

// Commandes récentes (simulées pour la démo)
$recent_orders = [
    [
        'id' => 'ORD-123456',
        'date' => '10/04/2025',
        'client' => 'Martin Dupont',
        'tickets' => '2 Adultes, 1 Enfant',
        'amount' => '38€',
        'status' => 'Complété'
    ],
    [
        'id' => 'ORD-123455',
        'date' => '10/04/2025',
        'client' => 'Sophie Durand',
        'tickets' => '1 Adulte, 2 Enfants',
        'amount' => '31€',
        'status' => 'Complété'
    ],
    [
        'id' => 'ORD-123454',
        'date' => '09/04/2025',
        'client' => 'Jean Lefebvre',
        'tickets' => '2 Adultes, 2 Enfants',
        'amount' => '46€',
        'status' => 'Complété'
    ],
    [
        'id' => 'ORD-123453',
        'date' => '09/04/2025',
        'client' => 'Marie Lambert',
        'tickets' => '1 Pack Famille',
        'amount' => '38€',
        'status' => 'Complété'
    ],
    [
        'id' => 'ORD-123452',
        'date' => '08/04/2025',
        'client' => 'Pierre Moreau',
        'tickets' => '2 Adultes, 1 Senior',
        'amount' => '42€',
        'status' => 'En attente'
    ]
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord | Musée des Lumières Évian</title>
    <link rel="stylesheet" href="CSS/styles.css">
    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Chart.js pour les graphiques -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .error-message {
            background-color: #fee2e2;
            color: #b91c1c;
            padding: 1rem;
            border-radius: var(--radius);
            margin-bottom: 1.5rem;
            text-align: center;
        }
        
        .admin-dashboard {
            display: flex;
            min-height: calc(100vh - 80px - 200px);
            background-color: #f9fafb;
        }
        
        .admin-sidebar {
            width: 250px;
            background-color: white;
            border-right: 1px solid #e5e7eb;
            padding: 1.5rem;
        }
        
        .admin-user {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding-bottom: 1.5rem;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .admin-avatar {
            font-size: 2rem;
            color: #6366f1;
        }
        
        .admin-info h3 {
            margin-bottom: 0;
            font-size: 1rem;
        }
        
        .admin-info p {
            margin-bottom: 0;
            font-size: 0.875rem;
            color: #6b7280;
        }
        
        .admin-nav ul {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .admin-nav li {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .admin-nav li:hover {
            background-color: #f9fafb;
        }
        
        .admin-nav li.active {
            background-color: #6366f1;
            color: white;
        }
        
        .admin-content {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
        }
        
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .admin-actions {
            display: flex;
            gap: 1rem;
        }
        
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            background-color: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        .stat-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            background-color: rgba(99, 102, 241, 0.1);
            color: #6366f1;
            border-radius: 50%;
            font-size: 1.5rem;
        }
        
        .stat-info h3 {
            font-size: 1rem;
            margin-bottom: 0.25rem;
        }
        
        .stat-value {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }
        
        .stat-change {
            font-size: 0.875rem;
            color: #6b7280;
        }
        
        .stat-change.positive {
            color: #10b981;
        }
        
        .stat-change.negative {
            color: #ef4444;
        }
        
        .admin-charts {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .chart-container {
            background-color: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .chart-header h3 {
            font-size: 1.125rem;
            margin-bottom: 0;
        }
        
        .chart-body {
            height: 250px;
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .section-header h3 {
            margin-bottom: 0;
        }
        
        .table-responsive {
            overflow-x: auto;
            margin-bottom: 1.5rem;
        }
        
        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .admin-table th, .admin-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .admin-table th {
            font-weight: 600;
            background-color: #f9fafb;
        }
        
        .admin-table tbody tr:hover {
            background-color: rgba(99, 102, 241, 0.05);
        }
        
        .order-status {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        .status-completed {
            background-color: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }
        
        .status-pending {
            background-color: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
        }
        
        .status-cancelled {
            background-color: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }
        
        .dark-mode .admin-dashboard {
            background-color: #111827;
        }
        
        .dark-mode .admin-sidebar,
        .dark-mode .stat-card,
        .dark-mode .chart-container {
            background-color: #1f2937;
            border-color: #374151;
        }
        
        .dark-mode .admin-nav li:hover {
            background-color: #111827;
        }
        
        .dark-mode .admin-table th {
            background-color: #111827;
        }
        
        /* Styles pour les statistiques détaillées */
        .stats-section {
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid #e5e7eb;
            margin-bottom: 1.5rem;
        }
        
        .section-header-colored {
            padding: 1.25rem 1.5rem;
            background-color: #6366f1;
            color: white;
        }
        
        .section-header-colored h2 {
            font-size: 1.25rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-family: 'Playfair Display', serif;
        }
        
        .data-table-container {
            padding: 1rem;
        }
        
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .data-table th,
        .data-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .data-table th {
            background-color: #f3f4f6;
            font-weight: 600;
            color: #1f2937;
        }
        
        .data-table tr:hover {
            background-color: rgba(99, 102, 241, 0.05);
        }
        
        .data-table .number-cell {
            text-align: center;
            font-weight: 600;
            color: #6366f1;
        }
        
        .empty-data {
            text-align: center;
            padding: 2rem;
            color: #6b7280;
            font-style: italic;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .iframe-container {
            width: 100%;
            height: 600px;
            border: none;
            margin-bottom: 1.5rem;
        }
        
        @media (max-width: 992px) {
            .admin-charts, .stats-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 768px) {
            .admin-dashboard {
                flex-direction: column;
            }
            
            .admin-sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #e5e7eb;
            }
            
            .stats-cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
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
                    <li><a href="expositions.html">Expositions</a></li>
                    <li><a href="admin-dashboard.php">Admin</a></li>
                    <li><a href="billetterie.php">Billetterie</a></li>
                    <li><a href="contact.html">Contact</a></li>

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
        <!-- Admin Dashboard -->
        <div class="admin-dashboard">
            <div class="admin-sidebar">
                <div class="admin-user">
                    <div class="admin-avatar">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <div class="admin-info">
                        <h3><?php echo htmlspecialchars($username); ?></h3>
                        <p>Connecté</p>
                    </div>
                </div>
                <nav class="admin-nav">
                    <ul>
                        <li class="active" data-tab="dashboard">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Tableau de bord</span>
                        </li>
                        <li data-tab="stats">
                            <i class="fas fa-chart-bar"></i>
                            <span>Statistiques</span>
                        </li>
                        <li data-tab="orders">
                            <i class="fas fa-ticket-alt"></i>
                            <span>Commandes</span>
                        </li>
                        <li data-tab="exhibitions">
                            <i class="fas fa-palette"></i>
                            <span>Expositions</span>
                        </li>
                        <li data-tab="events">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Événements</span>
                        </li>
                        <li data-tab="users">
                            <i class="fas fa-users"></i>
                            <span>Utilisateurs</span>
                        </li>
                        <li data-tab="settings">
                            <i class="fas fa-cog"></i>
                            <span>Paramètres</span>
                        </li>
                        <li id="logout-btn">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Déconnexion</span>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="admin-content">
                <!-- Dashboard Tab -->
                <div class="admin-tab active" id="dashboard-tab">
                    <div class="admin-header">
                        <h2>Tableau de bord</h2>
                        <div class="admin-actions">
                            <button class="btn small-btn">
                                <i class="fas fa-download"></i>
                                Exporter
                            </button>
                            <button class="btn primary-btn small-btn">
                                <i class="fas fa-plus"></i>
                                Nouvelle exposition
                            </button>
                        </div>
                    </div>
                    <div class="stats-cards">
                        <?php if ($db_connected): ?>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-info">
                                <h3>Visiteurs actuels</h3>
                                <p class="stat-value"><?php echo number_format($actuels['total'], 0, ',', ' '); ?></p>
                                <p class="stat-change">Présents dans le musée</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-calendar-day"></i>
                            </div>
                            <div class="stat-info">
                                <h3>Visiteurs aujourd'hui</h3>
                                <p class="stat-value"><?php echo number_format($aujourdhui['total'], 0, ',', ' '); ?></p>
                                <p class="stat-change">Total des entrées du jour</p>
                            </div>
                        </div>
                        <?php else: ?>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-ticket-alt"></i>
                            </div>
                            <div class="stat-info">
                                <h3>Billets vendus</h3>
                                <p class="stat-value"><?php echo number_format($stats['total_tickets'], 0, ',', ' '); ?></p>
                                <p class="stat-change positive">+12% depuis le mois dernier</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-euro-sign"></i>
                            </div>
                            <div class="stat-info">
                                <h3>Revenus</h3>
                                <p class="stat-value"><?php echo number_format($stats['total_revenue'], 0, ',', ' '); ?> €</p>
                                <p class="stat-change positive">+8% depuis le mois dernier</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-info">
                                <h3>Visiteurs</h3>
                                <p class="stat-value"><?php echo number_format($stats['total_visitors'], 0, ',', ' '); ?></p>
                                <p class="stat-change positive">+15% depuis le mois dernier</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div class="stat-info">
                                <h3>Commandes</h3>
                                <p class="stat-value"><?php echo number_format($stats['total_bookings'], 0, ',', ' '); ?></p>
                                <p class="stat-change positive">+5% depuis le mois dernier</p>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="admin-charts">
                        <div class="chart-container">
                            <div class="chart-header">
                                <h3>Répartition des billets</h3>
                                <div class="chart-actions">
                                    <button class="btn text-btn">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="chart-body">
                                <canvas id="ticket-types-chart"></canvas>
                            </div>
                        </div>
                        <div class="chart-container">
                            <div class="chart-header">
                                <h3>Réservations par jour</h3>
                                <div class="chart-actions">
                                    <button class="btn text-btn">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="chart-body">
                                <canvas id="bookings-chart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="recent-orders">
                        <div class="section-header">
                            <h3>Commandes récentes</h3>
                            <a href="#" class="btn text-btn">Voir toutes les commandes</a>
                        </div>
                        <div class="table-responsive">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Client</th>
                                        <th>Billets</th>
                                        <th>Montant</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recent_orders as $order): ?>
                                    <tr>
                                        <td><?php echo $order['id']; ?></td>
                                        <td><?php echo $order['date']; ?></td>
                                        <td><?php echo $order['client']; ?></td>
                                        <td><?php echo $order['tickets']; ?></td>
                                        <td><?php echo $order['amount']; ?></td>
                                        <td>
                                            <?php 
                                            $status_class = '';
                                            switch ($order['status']) {
                                                case 'Complété':
                                                    $status_class = 'status-completed';
                                                    break;
                                                case 'En attente':
                                                    $status_class = 'status-pending';
                                                    break;
                                                case 'Annulé':
                                                    $status_class = 'status-cancelled';
                                                    break;
                                            }
                                            ?>
                                            <span class="order-status <?php echo $status_class; ?>"><?php echo $order['status']; ?></span>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- Statistics Tab -->
                <div class="admin-tab" id="stats-tab">
                    <div class="admin-header">
                        <h2>Statistiques détaillées</h2>
                        <div class="admin-actions">
                            <button class="btn small-btn">
                                <i class="fas fa-download"></i>
                                Exporter
                            </button>
                            <button class="btn primary-btn small-btn">
                                <i class="fas fa-sync-alt"></i>
                                Actualiser
                            </button>
                        </div>
                    </div>
                    
                    <?php if ($db_connected): ?>
                    <!-- Statistiques réelles depuis la base de données -->
                    <div class="stats-cards">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-info">
                                <h3>Visiteurs actuels</h3>
                                <p class="stat-value"><?php echo number_format($actuels['total'], 0, ',', ' '); ?></p>
                                <p class="stat-change">Personnes présentes dans le musée</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-calendar-day"></i>
                            </div>
                            <div class="stat-info">
                                <h3>Visiteurs aujourd'hui</h3>
                                <p class="stat-value"><?php echo number_format($aujourdhui['total'], 0, ',', ' '); ?></p>
                                <p class="stat-change">Total des entrées du jour</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="stats-grid">
                        <div class="stats-section">
                            <div class="section-header-colored">
                                <h2><i class="fas fa-palette"></i> Fréquentation par Exposition</h2>
                            </div>
                            <div class="data-table-container">
                                <table class="data-table">
                                    <thead>
                                        <tr>
                                            <th>Exposition</th>
                                            <th>Nombre de Visiteurs</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($stats_expos as $expo): ?>
                                            <tr>
                                                  ?>
                                            <tr>
                                                <td><?= htmlspecialchars($expo["Libelle"]) ?></td>
                                                <td class="number-cell"><?= $expo["nombre_visiteurs"] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <?php if (empty($stats_expos)): ?>
                                            <tr>
                                                <td colspan="2" class="empty-data">Aucune donnée disponible</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="stats-section">
                            <div class="section-header-colored">
                                <h2><i class="fas fa-ticket-alt"></i> Répartition par Type d'Entrée</h2>
                            </div>
                            <div class="data-table-container">
                                <table class="data-table">
                                    <thead>
                                        <tr>
                                            <th>Type d'Entrée</th>
                                            <th>Nombre de Visiteurs</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($stats_types as $type): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($type["Libelle"]) ?></td>
                                                <td class="number-cell"><?= $type["nombre_visiteurs"] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <?php if (empty($stats_types)): ?>
                                            <tr>
                                                <td colspan="2" class="empty-data">Aucune donnée disponible</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <!-- Message d'erreur si la base de données n'est pas connectée -->
                    <div class="error-message">
                        <p><i class="fas fa-exclamation-triangle"></i> Impossible de se connecter à la base de données. Les statistiques détaillées ne sont pas disponibles.</p>
                    </div>
                    
                    <!-- Afficher l'iframe comme solution de secours -->
                    <div class="chart-container">
                        <div class="chart-header">
                            <h3>Statistiques externes</h3>
                        </div>
                        <iframe src="statistiques.php" class="iframe-container" title="Statistiques du musée"></iframe>
                    </div>
                    <?php endif; ?>
                </div>
                
                <!-- Autres onglets (vides pour l'instant) -->
                <div class="admin-tab" id="orders-tab">
                    <div class="admin-header">
                        <h2>Gestion des commandes</h2>
                    </div>
                    <p>Contenu en cours de développement...</p>
                </div>
                
                <div class="admin-tab" id="exhibitions-tab">
                    <div class="admin-header">
                        <h2>Gestion des expositions</h2>
                    </div>
                    <p>Contenu en cours de développement...</p>
                </div>
                
                <div class="admin-tab" id="events-tab">
                    <div class="admin-header">
                        <h2>Gestion des événements</h2>
                    </div>
                    <p>Contenu en cours de développement...</p>
                </div>
                
                <div class="admin-tab" id="users-tab">
                    <div class="admin-header">
                        <h2>Gestion des utilisateurs</h2>
                    </div>
                    <p>Contenu en cours de développement...</p>
                </div>
                
                <div class="admin-tab" id="settings-tab">
                    <div class="admin-header">
                        <h2>Paramètres</h2>
                    </div>
                    <p>Contenu en cours de développement...</p>
                </div>
            </div>
        </div>
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
    <script>
        // Graphique de répartition des types de billets
        const ticketTypesCtx = document.getElementById('ticket-types-chart').getContext('2d');
        const ticketTypesChart = new Chart(ticketTypesCtx, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode(array_keys($ticket_types)); ?>,
                datasets: [{
                    data: <?php echo json_encode(array_values($ticket_types)); ?>,
                    backgroundColor: [
                        '#6366f1',
                        '#8b5cf6',
                        '#ec4899',
                        '#f43f5e',
                        '#f59e0b'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right'
                    }
                }
            }
        });
        
        // Graphique des réservations par jour
        const bookingsCtx = document.getElementById('bookings-chart').getContext('2d');
        const bookingsChart = new Chart(bookingsCtx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_keys($booking_dates)); ?>,
                datasets: [{
                    label: 'Réservations',
                    data: <?php echo json_encode(array_values($booking_dates)); ?>,
                    backgroundColor: '#6366f1',
                    borderColor: '#4f46e5',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        
        // Navigation entre les onglets
        const navItems = document.querySelectorAll('.admin-nav li[data-tab]');
        const tabs = document.querySelectorAll('.admin-tab');
        
        navItems.forEach(item => {
            item.addEventListener('click', function() {
                const tabId = this.getAttribute('data-tab');
                
                // Update active nav item
                navItems.forEach(navItem => navItem.classList.remove('active'));
                this.classList.add('active');
                
                // Show selected tab
                tabs.forEach(tab => {
                    tab.classList.remove('active');
                    if (tab.id === `${tabId}-tab`) {
                        tab.classList.add('active');
                    }
                });
            });
        });
        
        // Déconnexion
        document.getElementById('logout-btn').addEventListener('click', function() {
            window.location.href = 'logout.php';
        });
    </script>
</body>
</html>