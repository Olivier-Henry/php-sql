<?php

$dsn = "mysql:host=127.0.0.1;dbname=formation_sql";
$connexion = new PDO($dsn, 'root', '');

//var_dump($connexion);

$rs = $connexion->query("SELECT * FROM personnes");

//var_dump($rs);

foreach ($rs as $row){
    //var_dump($row);
    echo $row['nom']."<br>";
}
