
<?php
$resultsE=null;
try {
    require_once "connection.inc.php";

    $query="SELECT id,nom,prenom,sexe,daten,paiement  FROM etudiants;";

    $stmt=$pdo->prepare($query);

    $stmt->execute();

    $resultsE=$stmt->fetchAll(PDO::FETCH_ASSOC);


    $pdo=null;
    $stmt=null;
} catch (PDOException $e) {
    die("Query failed".$e->getMessage());
}

