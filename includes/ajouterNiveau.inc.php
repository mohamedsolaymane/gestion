<?php
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["labelle"])){
    $labelle=$_POST["labelle"];
    try {
        require_once "connection.inc.php";

        $query0="SELECT labelle FROM nivau where labelle=:labelle";
        $stmt0=$pdo->prepare($query0);
        $stmt0->execute([":labelle"=>$labelle]);
        $ise=$stmt0->fetch()["labelle"];
        if(!isset($ise)){
            $query="INSERT INTO nivau(labelle) VALUES(:labelle);";
            $stmt=$pdo->prepare($query);
            $stmt->bindParam(":labelle",$labelle);
            $stmt->execute();
            $_SESSION["message2"]=0;
        }
        else{
            $_SESSION["message2"]=1;
        }
        $pdo=null;
        $stmt=null;
        $stmt0=null;

        header("Location:../ajouterNiveau.php");

        die();
    } catch (PDOException $e){
        die("Query failed".$e->getMessage());
    }

}
else{
    header("Location:../ajouterNiveau.php");
}