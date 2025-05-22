<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Gestion du Musée</title>
    <style>
        /* Styles généraux */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        body {
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }

        /* Barre de navigation */
        .navbar {
            width: 100%;
            background-color: #6366f1;
            display: flex;
            justify-content: center;
            padding: 15px 0;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .navbar button {
            background: none;
            border: none;
            color: white;
            font-size: 18px;
            font-weight: bold;
            padding: 10px 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .navbar button:hover {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
        }

        /* Contenu principal */
        .container {
            width: 90%;
            max-width: 1200px;
            margin-top: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        iframe {
            width: 100%;
            height: 80vh;
            border: none;
            border-radius: 0px 0px 10px 10px;
        }

        /* Titre */
        h1 {
            margin-top: 20px;
            color: #333;
            font-size: 24px;
            text-align: center;
        }
    </style>
    <script>
        function changePage(page) {
            document.getElementById('contentFrame').src = page;
        }
    </script>
</head>
<body>

<h1>🎛️ Panel de Gestion du Musée</h1>

<div class="navbar">
    <button onclick="changePage('musee.php')">Gestion des Entrées</button>
    <button onclick="changePage('statistiques.php')">Statistiques</button>
</div>

<div class="container">
    <iframe id="contentFrame" src="musee.php"></iframe>
</div>

</body>
</html>
