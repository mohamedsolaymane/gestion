<?php
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $groupe=$_POST["groupe"];
    $_SESSION["idG"]=(int) $groupe;
    $buttonSearch=$_POST["searchbutton"];
    if(empty($_SESSION["searchbutton"])){
        $buttonSearch="i";
    }

    try {
        //connection
        require_once "connection.inc.php";

        $query ="SELECT etudiants.id,etudiants.nom,etudiants.prenom,etudiants.sexe,etudiants.daten FROM etudiants
        INNER JOIN group_etu ON etudiants.id = group_etu.id_etu
        INNER JOIN groupe ON group_etu.id_group = groupe.id
        WHERE groupe.id=:group;";
        
        $stmt= $pdo->prepare($query);

        $stmt->bindParam(":group",$groupe);

        $stmt->execute();

        $resultsGroup=$stmt->fetchAll(PDO::FETCH_ASSOC);

        $_SESSION["results"]=$resultsGroup;
        $_SESSION["searchbutton"]=$buttonSearch;


        $pdo=null;
        $stmt=null;
        
        header("Location:../gestion.php");
    } catch (\PDOException $e) {
        die("Query failed".$e->getMessage());
    }
}
else{
    header("Location:../gestion.php");
};