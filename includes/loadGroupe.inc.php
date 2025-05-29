
<?php
$resultsGroupe=null;
try {
    require_once "connection.inc.php";

    $query="SELECT *  FROM groupe;";

    $stmt=$pdo->prepare($query);

    $stmt->execute();

    $resultsGroupe=$stmt->fetchAll(PDO::FETCH_ASSOC);


    $pdo=null;
    $stmt=null;
} catch (PDOException $e) {
    die("Query failed".$e->getMessage());
}

