
<?php
if($_SERVER["REQUEST_METHOD"]=="GET"){
try {
    require_once "connection.inc.php";

        // Query the database to get items based on the category ID
        $sql = "SELECT formation.labelle,formation.id
                FROM formation;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    
        
        // Send the response as JSON
        echo json_encode($result);
} catch (PDOException $e) {
    die("Query failed".$e->getMessage());
}
}
else{
    header("Location:../ajouter.php");
}




