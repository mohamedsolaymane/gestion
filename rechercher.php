<?php

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $matier=$_POST["matier"];

    try {
        //connection
        require_once "includes/connection.inc.php";

        $query ="SELECT etudiants.nom,etudiants.prenom,etudiants.sexe,etudiants.daten FROM etudiants
        INNER JOIN etu_mat ON etudiants.id = etu_mat.id_etu
        INNER JOIN matiers ON etu_mat.id_mat = matiers.id
        WHERE labelle=:matier;";
        
        $stmt= $pdo->prepare($query);//submiting the query

        //binding
        $stmt->bindParam(":matier",$matier);

        $stmt->execute();

        //Fetching is the process of grabbing data from the database and making it available to the application
        $results=$stmt->fetchAll(PDO::FETCH_ASSOC);//fetchALL for multiple data//ASSOC:associtif array {username1:comment1,username2:comment2]

        //closing connection and statement
        $pdo=null;
        $stmt=null;

    } catch (\PDOException $e) {
        die("Query failed".$e->getMessage());
    }
}
else{
    header("Location:gestion.php");
}
