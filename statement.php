<?php


//exemple de requete pouvant prendre des injection sql
$sql = "SELECT * FROM personnes WHERE id=". $_GET['id'];

echo $sql;


//Il vaut mieux utiliser pour s'en prémunir
$sql = "SELECT * FROM personnes WHERE id='". $_GET['id']."'";

echo $sql;