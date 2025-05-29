
<?php
$resultsMatier=null;
try {
    require_once "connection.inc.php";

    $query="SELECT *  FROM matiers;";

    $stmt=$pdo->prepare($query);

    $stmt->execute();

    $resultsMatier=$stmt->fetchAll(PDO::FETCH_ASSOC);


    $pdo=null;
    $stmt=null;
} catch (PDOException $e) {
    die("Query failed".$e->getMessage());
}

foreach($resultsMatier as $mat){
    echo
        "<option>".$mat["labelle"]."</option>";
};
