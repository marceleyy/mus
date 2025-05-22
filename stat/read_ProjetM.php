<?php

require_once 'dbconnect.php';
$bdd = dbconnect();

$query = ("select * from Visiteur;");
$Result = $bdd->query($query);


foreach ($Result as $row) {
    echo $row['IDVisiteur'] . "<br>";
    echo $row['IDExposition'] . "<br>";
}
