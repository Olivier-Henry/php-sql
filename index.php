<?php

$dsn = "mysql:host=127.0.0.1;dbname=formation_sql";
$connexion = new PDO($dsn, 'root', '', array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ));


try {
//var_dump($connexion);

    $rs = $connexion->query("SELECT * FROM personnes");

//var_dump($rs);

    foreach ($rs as $row) {
        //var_dump($row);
        echo $row['nom'] . "<br>";
    }

    $sql = "UPDATE personnes SET date_naissance='1990-01-01' WHERE date_naissance IS NULL";

    $nb = $connexion->exec($sql);
    echo "<p> $nb lignes ont été modifiées";

    $sql = "INSERT INTO personnes (nom, prenom) VALUES ('Lokuggug','Davdiugiug')";
    $nb = $connexion->exec($sql);
    echo "<p> $nb lignes ont été insérées</p>";

    echo "<p>Les dernier id est : " . $connexion->lastInsertId() . "</p>";
} catch (PDOException $ex) {
    echo $ex->getMessage();
}