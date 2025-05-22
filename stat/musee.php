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

$bdd = dbconnect();

// Gestion de l'ajout des visiteurs
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nom"], $_POST["prenom"], $_POST["heure_arrivee"], $_POST["id_type_entree"])) {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $heure_arrivee = $_POST["heure_arrivee"];
    $id_type_entree = $_POST["id_type_entree"];
    $id_exposition = $_POST["id_exposition"] ?? null;

    // Récupérer la date du jour automatiquement
    $date = date("Y-m-d");

    // Insérer le visiteur avec la date du jour
    $stmt = $bdd->prepare("INSERT INTO Visiteur (Nom, Prenom, Heure_Arrivee, Date, ID_Type_Entree) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nom, $prenom, $heure_arrivee, $date, $id_type_entree]);

    $id_visiteur = $bdd->lastInsertId();

    // Si une exposition est sélectionnée, enregistrer la visite
    if ($id_exposition) {
        $stmt_visite = $bdd->prepare("INSERT INTO Visite (ID_Visiteur, ID_Exposition, Date_Visite) VALUES (?, ?, ?)");
        $stmt_visite->execute([$id_visiteur, $id_exposition, $date]);
    }
}

// Gestion des sorties des visiteurs
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["visiteur_id"], $_POST["heure_depart"])) {
    $stmt = $bdd->prepare("UPDATE Visiteur SET Heure_Depart = ? WHERE ID = ?");
    $stmt->execute([$_POST["heure_depart"], $_POST["visiteur_id"]]);
}

// Récupérer les visiteurs actuellement présents
$sql = "SELECT * FROM Visiteur WHERE Heure_Depart IS NULL";
$visiteurs = $bdd->query($sql)->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les types d'entrée
$types_entree = $bdd->query("SELECT * FROM Type_Entree")->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les expositions
$expositions = $bdd->query("SELECT * FROM Exposition")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Visiteurs | Musée des Lumières</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #6366f1;
            --primary-hover: #4f46e5;
            --secondary-color: #f3f4f6;
            --accent-color: #bc8efa;
            --success-color: #10b981;
            --success-hover: #059669;
            --text-color: #1f2937;
            --text-light: #6b7280;
            --background: #ffffff;
            --card-bg: #ffffff;
            --border-color: #e5e7eb;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --transition: all 0.3s ease;
            --radius: 8px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--secondary-color);
            color: var(--text-color);
            line-height: 1.6;
            padding: 2rem;
        }

        .page-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            color: var(--text-color);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .page-title i {
            color: var(--primary-color);
        }

        .page-subtitle {
            color: var(--text-light);
            font-size: 1.1rem;
            font-weight: 300;
        }

        .container {
            max-width: 900px;
            margin: 0 auto 2rem auto;
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        .container-header {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            padding: 1.5rem;
            font-family: 'Playfair Display', serif;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .container-header h2 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .container-body {
            padding: 2rem;
        }

        /* Form Styles */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-color);
        }

        input, select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            transition: var(--transition);
        }

        input:focus, select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius);
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            font-size: 1rem;
            font-family: 'Poppins', sans-serif;
            width: auto;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
        }

        .btn-success {
            background-color: var(--success-color);
            color: white;
        }

        .btn-success:hover {
            background-color: var(--success-hover);
            transform: translateY(-1px);
        }

        .btn-time {
            background-color: var(--secondary-color);
            color: var(--text-color);
            border: 1px solid var(--border-color);
        }

        .btn-time:hover {
            background-color: var(--border-color);
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 1rem;
        }

        /* Table Styles */
        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        th {
            background-color: var(--secondary-color);
            font-weight: 600;
            color: var(--text-color);
        }

        tr:hover {
            background-color: rgba(99, 102, 241, 0.05);
        }

        .departure-form {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .departure-form input {
            max-width: 120px;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: var(--text-light);
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--border-color);
            margin-bottom: 1rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .container-body {
                padding: 1.5rem;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .departure-form {
                flex-direction: column;
                align-items: flex-start;
            }

            .departure-form input,
            .departure-form button {
                width: 100%;
                margin-bottom: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="page-header">
        <h1 class="page-title"><i class="fas fa-users"></i> Gestion des Visiteurs</h1>
        <p class="page-subtitle">Musée des Lumières | Évian</p>
    </div>

    <div class="container">
        <div class="container-header">
            <i class="fas fa-user-plus"></i>
            <h2>Ajouter un Visiteur</h2>
        </div>
        <div class="container-body">
            <form method="POST">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="nom">Nom :</label>
                        <input type="text" id="nom" name="nom" required>
                    </div>

                    <div class="form-group">
                        <label for="prenom">Prénom :</label>
                        <input type="text" id="prenom" name="prenom" required>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="heure_arrivee">Heure d'Arrivée :</label>
                        <div style="display: flex; gap: 0.5rem;">
                            <input type="time" id="heure_arrivee" name="heure_arrivee" required>
                            <button type="button" class="btn btn-time" onclick="setCurrentTime('heure_arrivee')">
                                <i class="fas fa-clock"></i> Maintenant
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="id_type_entree">Type d'Entrée :</label>
                        <select id="id_type_entree" name="id_type_entree" required>
                            <?php foreach ($types_entree as $type): ?>
                                <option value="<?= $type['ID'] ?>"><?= htmlspecialchars($type['Libelle']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="id_exposition">Exposition :</label>
                    <select id="id_exposition" name="id_exposition">
                        <option value="">Aucune</option>
                        <?php foreach ($expositions as $expo): ?>
                            <option value="<?= $expo['ID'] ?>"><?= htmlspecialchars($expo['Libelle']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i> Ajouter Visiteur
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="container-header">
            <i class="fas fa-list"></i>
            <h2>Visiteurs Actuellement Présents</h2>
        </div>
        <div class="container-body">
            <?php if (count($visiteurs) > 0): ?>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Heure d'Arrivée</th>
                                <th>Départ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($visiteurs as $visiteur): ?>
                                <tr>
                                    <td><?= htmlspecialchars($visiteur["Nom"]) ?></td>
                                    <td><?= htmlspecialchars($visiteur["Prenom"]) ?></td>
                                    <td><?= htmlspecialchars($visiteur["Heure_Arrivee"]) ?></td>
                                    <td>
                                        <form method="POST" class="departure-form">
                                            <input type="hidden" name="visiteur_id" value="<?= $visiteur['ID'] ?>">
                                            <input type="time" name="heure_depart" id="depart_<?= $visiteur['ID'] ?>" required>
                                            <button type="button" class="btn btn-time" onclick="setCurrentTime('depart_<?= $visiteur['ID'] ?>')">
                                                <i class="fas fa-clock"></i>
                                            </button>
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-sign-out-alt"></i> Sortie
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-user-slash"></i>
                    <p>Aucun visiteur actuellement présent dans le musée</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function setCurrentTime(inputId) {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const formattedTime = `${hours}:${minutes}`;
            document.getElementById(inputId).value = formattedTime;
        }
    </script>
</body>
</html>