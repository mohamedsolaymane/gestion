
<?php
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["ide"])){
$id=$_POST["ide"];
$paiement=$_POST["paiement"];
try {
    require_once "connection.inc.php";
    $query="UPDATE etudiants
            SET paiement = :paiement
            WHERE id=:ide;";
    $stmt=$pdo->prepare($query);
    $stmt->execute([":ide"=>$id,":paiement"=>$paiement]);
    $pdo=null;
    $stmt=null;
    header("Location:../paiement.php");
    die();
}
catch (PDOException $e) {
    die("Query failed".$e->getMessage());
}
}
else{
    header("Location:../paiement.php");
    exit();
}




