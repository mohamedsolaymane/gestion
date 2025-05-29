
<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
$id=$_POST["ide"];
$nom=$_POST["nom"];
$prenom=$_POST["prenom"];
$sexe=$_POST["sexe"];
$daten=$_POST["daten"];
try {
    require_once "connection.inc.php";
    $query="UPDATE etudiants
            SET nom = :nom, prenom = :prenom, sexe = :sexe, daten = :daten
            WHERE id=:ide;";
    $stmt=$pdo->prepare($query);
    $stmt->execute([":ide"=>$id,":nom"=>$nom,":prenom"=>$prenom,":sexe"=>$sexe,":daten"=>$daten]);
    $pdo=null;
    $stmt=null;
    header("Location:../gestion.php");
    die();
}
catch (PDOException $e) {
    die("Query failed".$e->getMessage());
}
}
else{
    header("Location:../gestion.php");
    exit();
}




