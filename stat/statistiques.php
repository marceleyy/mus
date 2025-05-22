<?php
// Connexion à SQLite
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

try {
    $bdd = dbconnect();
    
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
        ORDER BY nombre_visiteurs DESC
    ")->fetchAll(PDO::FETCH_ASSOC);
    
    // Statistiques des types d'entrée
    $stats_types = $bdd->query("
        SELECT t.Libelle, COUNT(v.ID) AS nombre_visiteurs
        FROM Visiteur v
        JOIN Type_Entree t ON v.ID_Type_Entree = t.ID
        GROUP BY t.ID
        ORDER BY nombre_visiteurs DESC
    ")->fetchAll(PDO::FETCH_ASSOC);
    
    // Préparer les données pour les graphiques
    $expo_labels = [];
    $expo_data = [];
    foreach ($stats_expos as $expo) {
        $expo_labels[] = $expo['Libelle'];
        $expo_data[] = $expo['nombre_visiteurs'];
    }
    
    $type_labels = [];
    $type_data = [];
    foreach ($stats_types as $type) {
        $type_labels[] = $type['Libelle'];
        $type_data[] = $type['nombre_visiteurs'];
    }
    
    // Succès de connexion
    $db_connected = true;
    
} catch (Exception $e) {
    // Échec de connexion
    $db_connected = false;
    $error_message = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques | Musée des Lumières</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Chart.js pour les graphiques -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="css/museum-styles.css">
    <style>
        :root {
            --primary: #6366f1;
            --primary-light: rgba(99, 102, 241, 0.1);
            --primary-dark: #4f46e5;
            --secondary: #8b5cf6;
            --accent: #ec4899;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
            --radius: 0.5rem;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--gray-50);
            color: var(--gray-800);
            line-height: 1.6;
            padding: 2rem;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .dashboard {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }
        
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .dashboard-title {
            font-family: 'Playfair Display', serif;
            color: var(--gray-900);
        }
        
        .dashboard-title h1 {
            font-size: 2.25rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .dashboard-title h1 i {
            color: var(--primary);
        }
        
        .dashboard-title p {
            font-size: 1.1rem;
            color: var(--gray-500);
            font-weight: 300;
        }
        
        .dashboard-actions {
            display: flex;
            gap: 1rem;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius);
            font-weight: 500;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            outline: none;
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: white;
            box-shadow: var(--shadow);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            box-shadow: var(--shadow-md);
            transform: translateY(-1px);
        }
        
        .btn-outline {
            background-color: transparent;
            color: var(--gray-700);
            border: 1px solid var(--gray-300);
            box-shadow: var(--shadow-sm);
        }
        
        .btn-outline:hover {
            background-color: var(--gray-50);
            border-color: var(--gray-400);
            box-shadow: var(--shadow);
        }
        
        .stats-overview {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .stat-card {
            background: linear-gradient(135deg, white, var(--gray-50));
            border-radius: var(--radius);
            box-shadow: var(--shadow-md);
            padding: 2rem;
            display: flex;
            align-items: center;
            gap: 2rem;
            transition: all 0.3s ease;
            border: 1px solid var(--gray-100);
            position: relative;
            overflow: hidden;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: var(--gray-200);
        }
        
        .stat-card::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.8));
            transform: skewX(-15deg) translateX(70px);
            transition: transform 0.5s ease;
        }
        
        .stat-card:hover::after {
            transform: skewX(-15deg) translateX(200px);
        }
        
        .stat-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 80px;
            height: 80px;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            font-size: 2rem;
            box-shadow: var(--shadow-md);
        }
        
        .stat-content {
            flex: 1;
        }
        
        .stat-content h3 {
            font-size: 1.25rem;
            color: var(--gray-600);
            font-weight: 500;
            margin-bottom: 0.75rem;
        }
        
        .stat-number {
            font-size: 3.5rem;
            font-weight: 700;
            color: var(--gray-900);
            line-height: 1;
            margin-bottom: 0.75rem;
            font-family: 'Playfair Display', serif;
        }
        
        .stat-description {
            color: var(--gray-500);
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .stat-description i {
            color: var(--success);
        }
        
        .charts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .chart-container {
            background-color: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow-md);
            overflow: hidden;
            border: 1px solid var(--gray-100);
            transition: all 0.3s ease;
        }
        
        .chart-container:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-3px);
        }
        
        .chart-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--gray-100);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .chart-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--gray-800);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .chart-title i {
            color: var(--primary);
        }
        
        .chart-actions {
            display: flex;
            gap: 0.5rem;
        }
        
        .chart-action {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--gray-50);
            color: var(--gray-600);
            border: 1px solid var(--gray-200);
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .chart-action:hover {
            background-color: var(--primary-light);
            color: var(--primary);
            border-color: var(--primary-light);
        }
        
        .chart-body {
            padding: 1.5rem;
            height: 350px;
        }
        
        .data-tables {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            gap: 2rem;
        }
        
        .data-table-container {
            background-color: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow-md);
            overflow: hidden;
            border: 1px solid var(--gray-100);
            transition: all 0.3s ease;
        }
        
        .data-table-container:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-3px);
        }
        
        .table-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--gray-100);
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }
        
        .table-title {
            font-size: 1.25rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-family: 'Playfair Display', serif;
        }
        
        .table-content {
            padding: 1rem;
            overflow-x: auto;
        }
        
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .data-table th,
        .data-table td {
            padding: 1.25rem 1rem;
            text-align: left;
        }
        
        .data-table th {
            background-color: var(--gray-50);
            font-weight: 600;
            color: var(--gray-700);
            border-bottom: 2px solid var(--gray-200);
            position: sticky;
            top: 0;
        }
        
        .data-table tr {
            border-bottom: 1px solid var(--gray-100);
            transition: background-color 0.2s ease;
        }
        
        .data-table tr:last-child {
            border-bottom: none;
        }
        
        .data-table tr:hover {
            background-color: var(--primary-light);
        }
        
        .data-table .number-cell {
            font-weight: 700;
            color: var(--primary);
            text-align: center;
            font-size: 1.1rem;
        }
        
        .empty-data {
            text-align: center;
            padding: 3rem;
            color: var(--gray-500);
            font-style: italic;
        }
        
        .error-container {
            background-color: #fee2e2;
            border: 1px solid #fecaca;
            border-radius: var(--radius);
            padding: 2rem;
            margin-bottom: 2rem;
            text-align: center;
            color: #b91c1c;
        }
        
        .error-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        
        .error-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .error-message {
            margin-bottom: 1.5rem;
        }
        
        .footer {
            margin-top: 3rem;
            text-align: center;
            color: var(--gray-500);
            font-size: 0.875rem;
        }
        
        @media (max-width: 1200px) {
            .charts-grid,
            .data-tables {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }
            
            .dashboard-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .stat-card {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
                padding: 1.5rem;
            }
            
            .stat-icon {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }
            
            .stat-number {
                font-size: 2.5rem;
            }
            
            .chart-body {
                height: 300px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="dashboard">
            <?php if ($db_connected): ?>
                <div class="dashboard-header">
                    <div class="dashboard-title">
                        <h1><i class="fas fa-chart-bar"></i> Statistiques du Musée</h1>
                        <p>Tableau de bord des données de fréquentation en temps réel</p>
                    </div>
                    <div class="dashboard-actions">
                        <button class="btn btn-outline">
                            <i class="fas fa-sync-alt"></i> Actualiser
                        </button>
                        <button class="btn btn-primary">
                            <i class="fas fa-download"></i> Exporter les données
                        </button>
                    </div>
                </div>
                
                <div class="stats-overview">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-content">
                            <h3>Visiteurs actuels</h3>
                            <p class="stat-number"><?= $actuels['total'] ?></p>
                            <p class="stat-description">
                                <i class="fas fa-circle-info"></i> Personnes présentes dans le musée
                            </p>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        <div class="stat-content">
                            <h3>Visiteurs aujourd'hui</h3>
                            <p class="stat-number"><?= $aujourdhui['total'] ?></p>
                            <p class="stat-description">
                                <i class="fas fa-circle-info"></i> Total des entrées du jour
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="charts-grid">
                    <div class="chart-container">
                        <div class="chart-header">
                            <h2 class="chart-title"><i class="fas fa-palette"></i> Fréquentation par Exposition</h2>
                            <div class="chart-actions">
                                <button class="chart-action" title="Afficher en camembert">
                                    <i class="fas fa-chart-pie"></i>
                                </button>
                                <button class="chart-action" title="Afficher en barres">
                                    <i class="fas fa-chart-bar"></i>
                                </button>
                            </div>
                        </div>
                        <div class="chart-body">
                            <canvas id="expositions-chart"></canvas>
                        </div>
                    </div>
                    
                    <div class="chart-container">
                        <div class="chart-header">
                            <h2 class="chart-title"><i class="fas fa-ticket-alt"></i> Répartition par Type d'Entrée</h2>
                            <div class="chart-actions">
                                <button class="chart-action" title="Afficher en camembert">
                                    <i class="fas fa-chart-pie"></i>
                                </button>
                                <button class="chart-action" title="Afficher en barres">
                                    <i class="fas fa-chart-bar"></i>
                                </button>
                            </div>
                        </div>
                        <div class="chart-body">
                            <canvas id="types-chart"></canvas>
                        </div>
                    </div>
                </div>
                
                <div class="data-tables">
                    <div class="data-table-container">
                        <div class="table-header">
                            <h2 class="table-title"><i class="fas fa-palette"></i> Fréquentation par Exposition</h2>
                        </div>
                        <div class="table-content">
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
                    
                    <div class="data-table-container">
                        <div class="table-header">
                            <h2 class="table-title"><i class="fas fa-ticket-alt"></i> Répartition par Type d'Entrée</h2>
                        </div>
                        <div class="table-content">
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
                <div class="error-container">
                    <div class="error-icon">
                        <i class="fas fa-database"></i>
                    </div>
                    <h2 class="error-title">Erreur de connexion à la base de données</h2>
                    <p class="error-message"><?= htmlspecialchars($error_message) ?></p>
                    <button class="btn btn-primary">
                        <i class="fas fa-sync-alt"></i> Réessayer
                    </button>
                </div>
            <?php endif; ?>
            
            <div class="footer">
                <p>&copy; <?= date('Y') ?> Musée des Lumières Évian - Statistiques générées le <?= date('d/m/Y à H:i:s') ?></p>
            </div>
        </div>
    </div>
    
    <?php if ($db_connected): ?>
    <script>
        // Configuration des graphiques
        const colors = [
            '#6366f1', // Primary
            '#8b5cf6', // Secondary
            '#ec4899', // Accent
            '#10b981', // Success
            '#f59e0b', // Warning
            '#ef4444', // Danger
            '#3b82f6',
            '#14b8a6',
            '#a855f7',
            '#f43f5e'
        ];
        
        // Graphique des expositions
        const expoCtx = document.getElementById('expositions-chart').getContext('2d');
        new Chart(expoCtx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($expo_labels) ?>,
                datasets: [{
                    label: 'Nombre de visiteurs',
                    data: <?= json_encode($expo_data) ?>,
                    backgroundColor: colors,
                    borderColor: colors.map(color => color),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(17, 24, 39, 0.9)',
                        titleFont: {
                            family: "'Playfair Display', serif",
                            size: 14
                        },
                        bodyFont: {
                            family: "'Poppins', sans-serif",
                            size: 13
                        },
                        padding: 12,
                        cornerRadius: 8
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(229, 231, 235, 0.5)'
                        },
                        ticks: {
                            font: {
                                family: "'Poppins', sans-serif"
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                family: "'Poppins', sans-serif"
                            }
                        }
                    }
                }
            }
        });
        
        // Graphique des types d'entrée
        const typesCtx = document.getElementById('types-chart').getContext('2d');
        new Chart(typesCtx, {
            type: 'doughnut',
            data: {
                labels: <?= json_encode($type_labels) ?>,
                datasets: [{
                    data: <?= json_encode($type_data) ?>,
                    backgroundColor: colors,
                    borderColor: 'white',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            font: {
                                family: "'Poppins', sans-serif"
                            },
                            padding: 20
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(17, 24, 39, 0.9)',
                        titleFont: {
                            family: "'Playfair Display', serif",
                            size: 14
                        },
                        bodyFont: {
                            family: "'Poppins', sans-serif",
                            size: 13
                        },
                        padding: 12,
                        cornerRadius: 8
                    }
                },
                cutout: '65%'
            }
        });
        
        // Gestion des boutons d'action des graphiques
        document.querySelectorAll('.chart-action').forEach(button => {
            button.addEventListener('click', function() {
                // Cette fonction serait implémentée pour changer le type de graphique
                // Pour une démo, on ajoute juste une classe active
                this.classList.toggle('active');
            });
        });
        
        // Gestion du bouton d'actualisation
        document.querySelector('.btn-outline').addEventListener('click', function() {
            location.reload();
        });
        
        // Gestion du bouton d'export (simulation)
        document.querySelector('.btn-primary').addEventListener('click', function() {
            alert('Export des données en cours...');
            // Ici on pourrait implémenter une fonction d'export réelle
        });
    </script>
    <?php endif; ?>
</body>
</html>