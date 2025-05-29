<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["labelle"])) {
    $labelle = $_POST["labelle"];

    try {
        require_once "connection.inc.php";


        $query = "SELECT labelle FROM formation WHERE labelle = :labelle";
        $stmt = $pdo->prepare($query);
        $stmt->execute([":labelle" => $labelle]);
        $existingLabel = $stmt->fetchColumn();

        if (!$existingLabel) {
            $sql = "INSERT INTO formation(labelle) VALUES(:labelle)";
            $stmt1 = $pdo->prepare($sql);
            $stmt1->bindParam(":labelle", $labelle);
            $stmt1->execute();
            $_SESSION["message1"] = 0; // Success
        } else {
            $_SESSION["message1"] = 1; // Already exists
        }

        // Cleanup
        $pdo = null;
        $stmt = null;
        $stmt1 = null;

        header("Location: ../ajouterFormation.php");
        exit;
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    $_SESSION["message1"] = 2;
    header("Location: ../ajouterFormation.php");
    exit;
}
