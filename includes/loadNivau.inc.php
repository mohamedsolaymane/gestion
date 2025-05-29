
<?php
$resultsNivau=null;
try {
    require_once "connection.inc.php";

    $query="SELECT *  FROM nivau;";

    $stmt=$pdo->prepare($query);

    $stmt->execute();

    $resultsNivau=$stmt->fetchAll(PDO::FETCH_ASSOC);


    $pdo=null;
    $stmt=null;
} catch (PDOException $e) {
    die("Query failed".$e->getMessage());
}

