<?php

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $id=$_POST["idE"];
    $idg=(int) $_POST["iddg"];

    try {
        require_once "connection.inc.php";

        $query0="SELECT group_etu.id_group
                FROM group_etu
                INNER JOIN etudiants ON group_etu.id_etu = etudiants.id
                WHERE id_etu=:id_etu"
                ;

        $stmt0=$pdo->prepare($query0);

        $stmt0->bindParam(":id_etu",$id);

        $stmt0->execute();

        $id_g=$stmt0->fetchAll();
        $stmt0->closeCursor();

        $id_gs = [];
        
        foreach ($id_g as $element) {
            $id_gs[] = $element['id_group'];
        }
        
        $query="DELETE from group_etu where id_etu=:id AND id_group=:idg";

        $stmt=$pdo->prepare($query);

        $stmt->bindParam(":id",$id);
        $stmt->bindParam(":idg",$idg);

        $stmt->execute();
        $stmt->closeCursor();

        foreach($id_gs as $e){
            $query01="SELECT COUNT(*) as count FROM group_etu where id_group=:id_g";
            $stmt01=$pdo->prepare($query01);
            $stmt01->bindParam(":id_g",$e);
            $stmt01->execute();
            $count=$stmt01->fetch()["count"];
            $stmt01->closeCursor();
            if($count==0){
                $query02="DELETE FROM groupe where id=:id_g";
                $stmt02=$pdo->prepare($query02);
                $stmt02->bindParam(":id_g",$e);
                $stmt02->execute();
                $stmt02->closeCursor();
            }
        }

        $query1="SELECT COUNT(*) as count FROM group_etu where id_etu=:id";

        $stmt1=$pdo->prepare($query1);

        $stmt1->bindParam(":id",$id);

        $stmt1->execute();
        $count1=$stmt1->fetch()["count"];
        $stmt1->closeCursor();

        if($count1==0){
            $query2="DELETE FROM etudiants where id=:id";
            $stmt2=$pdo->prepare($query2);
            $stmt2->bindParam(":id",$id);
            $stmt2->execute();
            $stmt2->closeCursor();
        }

        $pdo=null;
        $stmt=null;
        $stmt0=null;
        $stmt01=null;
        $stmt02=null;
        $stmt1=null;
        $stmt2=null;
        header("Location:../gestion.php");

        die();
    } catch (PDOException $e){
        die("Query failed".$e->getMessage());
    }

}
else{
    header("Location:../gestion.php");
}