<?php
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $nom=$_POST["nom"];
    $prenom=$_POST["prenom"];
    $sexe=$_POST["sexe"];
    $daten=$_POST["daten"];
    $niveau=$_POST["niveau"];
    $formation=$_POST["formation"];
    $labelleFormation=null;
    $labelleNiveau=null;

    try {
        require_once "connection.inc.php";

        $query0="SELECT id
                FROM etudiants
                WHERE nom=:nom and prenom=:prenom and sexe=:sexe and daten=:daten;";

        $stmt0=$pdo->prepare($query0);

        $stmt0->bindParam(":nom",$nom);
        $stmt0->bindParam(":prenom",$prenom);
        $stmt0->bindParam(":sexe",$sexe);
        $stmt0->bindParam(":daten",$daten);

        $stmt0->execute();
        $exist=($stmt0->fetch())["id"];

        if($exist){
        $query01="SELECT group_etu.id_group
        FROM group_etu
        INNER JOIN etudiants ON group_etu.id_etu = etudiants.id
        WHERE id_etu=:id_etu";

        $stmt01=$pdo->prepare($query01);

        $stmt01->bindParam(":id_etu",$exist);

        $stmt01->execute();
        $existIngroup=($stmt01->fetch())["id_group"];
        }
        if(!$exist){
        $query="INSERT INTO etudiants(nom,prenom,sexe,daten) VALUES(:nom,:prenom,:sexe,:daten);";

        $stmt=$pdo->prepare($query);

        $stmt->bindParam(":nom",$nom);
        $stmt->bindParam(":prenom",$prenom);
        $stmt->bindParam(":sexe",$sexe);
        $stmt->bindParam(":daten",$daten);

        $stmt->execute();

        $id_etu = $pdo->lastInsertId();

        $sql="SELECT labelle from nivau where id=:id_nivau";

        $stmt1=$pdo->prepare($sql);

        $stmt1->bindParam(":id_nivau",$niveau);

        $stmt1->execute();

        $resultsNivau=$stmt1->fetch();

        $sql2="SELECT labelle from formation where id=:id_formation";

        $stmt2=$pdo->prepare($sql2);
    
        $stmt2->bindParam(":id_formation",$formation);

        $stmt2->execute();

        $resultsFormation=$stmt2->fetch();

        $groupe_name=$resultsNivau["labelle"]."_".$resultsFormation["labelle"];

        $sql5="SELECT id FROM groupe where labelle=:labelle ";
        
        $stmt5=$pdo->prepare($sql5);

        $stmt5->bindParam(":labelle",$groupe_name);

        $stmt5->execute();

        $id_g=$stmt5->fetch();

        if ($id_g) {
            $id_groupe=$id_g["id"];
        } else {
            $sql3="INSERT INTO groupe(labelle,id_nivau,id_formation) VALUES (:labelle,:id_nivau,:id_formation)";

            $stmt3=$pdo->prepare($sql3);

            $stmt3->bindParam(":labelle",$groupe_name);
            $stmt3->bindParam(":id_nivau",$niveau);
            $stmt3->bindParam(":id_formation",$formation);

            $stmt3->execute();

            $id_groupe = $pdo->lastInsertId();
        }

        $sql4="INSERT INTO group_etu(id_etu,id_group) VALUES (:id_etu,:id_group)";

        $stmt4=$pdo->prepare($sql4);

        $stmt4->bindParam(":id_etu",$id_etu);
        $stmt4->bindParam(":id_group",$id_groupe);

        $stmt4->execute();
        }
        else{

        $sql="SELECT labelle from nivau where id=:id_nivau";

        $stmt1=$pdo->prepare($sql);

        $stmt1->bindParam(":id_nivau",$niveau);

        $stmt1->execute();

        $resultsNivau=$stmt1->fetch();

        $sql2="SELECT labelle from formation where id=:id_formation";

        $stmt2=$pdo->prepare($sql2);
    
        $stmt2->bindParam(":id_formation",$formation);

        $stmt2->execute();

        $resultsFormation=$stmt2->fetch();

        $groupe_name=$resultsNivau["labelle"]."_".$resultsFormation["labelle"];

        $sql5="SELECT id FROM groupe where labelle=:labelle ";
        
        $stmt5=$pdo->prepare($sql5);

        $stmt5->bindParam(":labelle",$groupe_name);

        $stmt5->execute();

        $id_g=$stmt5->fetch();

        if ($id_g) {
            if($id_g["id"]==$existIngroup){
                $error=1; //if he exist and i want to join it in the same group again
            }
            else{
                $id_groupe=$id_g["id"];
            }
        } else {
            $sql3="INSERT INTO groupe(labelle,id_nivau,id_formation) VALUES (:labelle,:id_nivau,:id_formation)";

            $stmt3=$pdo->prepare($sql3);

            $stmt3->bindParam(":labelle",$groupe_name);
            $stmt3->bindParam(":id_nivau",$niveau);
            $stmt3->bindParam(":id_formation",$formation);

            $stmt3->execute();

            $id_groupe = $pdo->lastInsertId();
        }

        if($id_groupe){
        $sql4="INSERT INTO group_etu(id_etu,id_group) VALUES (:id_etu,:id_group)";

        $stmt4=$pdo->prepare($sql4);

        $stmt4->bindParam(":id_etu",$exist);
        $stmt4->bindParam(":id_group",$id_groupe);

        $stmt4->execute();
        }else {
            $error=1;
        }
        }

        if($error==1){
            $_SESSION["message"]=1;
        }
        $pdo=null;
        $stmt=null;
        $stmt1=null;
        $stmt2=null;
        $stmt3=null;
        $stmt4=null;
        $stmt5=null;
        $stmt0=null;
        $stmt01=null;

        header("Location:../ajouter.php");

        die();
    } catch (PDOException $e){
        die("Query failed".$e->getMessage());
    }

}
else{
    header("Location:../ajouter.php");
}
