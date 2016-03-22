<?php

//exemple de requete pouvant prendre des injection sql
//$sql = "SELECT * FROM personnes WHERE id=". $_GET['id'];
//
//echo $sql;
//
//
////Il vaut mieux utiliser pour s'en prémunir
//$sql = "SELECT * FROM personnes WHERE id='". $_GET['id']."'";
//
//echo $sql;


$dsn = "mysql:host=127.0.0.1;dbname=formation_sql";
$connexion = new PDO($dsn, 'root', '', array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ));


try {

    //pour un rollback
    $connexion->beginTransaction();

    // Les prepared statements (requêtes préparées)
    $id = $_GET['id'];
    $sql = "SELECT * FROM personnes WHERE personne_id=?";
    //$sql = "SELECT * FROM personnes WHERE personne_id=:id"; <--- pour passer un tableau associatif

    $statement = $connexion->prepare($sql);
    $statement->execute([$id]);
    //$statement->execute(['id' => $id]); <- dans le cas tab associatif
    $rs = $statement->fetch(PDO::FETCH_OBJ);
    var_dump($rs);

    //autre exemple
    $sql = "INSERT INTO personnes (nom, prenom, date_naissance) VALUES(:nom, :prenom, :date)";
    $statement = $connexion->prepare($sql);

    $data = array(
        array('nom' => 'Lovelace', 'prenom' => 'Ada', 'date' => null),
        array('nom' => 'Lovelace', 'prenom' => 'Georges', 'date' => null)
    );

    foreach ($data as $personne) {
        $statement->execute($personne);
    }

    //Pour le rollback
    $connexion->commit();
} catch (PDOException $ex) {
    echo $ex->getMessage();

    //rollback
    $connexion->rollBack();
}
