<?php
function dbconnect()
{
    try {
        $bdd = new PDO('sqlite:ProjetM.db');

        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo "CONNEXION à ProjetM OK </br>";
    } catch (Exception $e) {
        die('Erreur de connexion à la base : ' . $e->getMessage());
    }

    return $bdd;
}
?>
