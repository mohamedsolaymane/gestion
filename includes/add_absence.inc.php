<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["student_id"])) {
    $student_id = $_POST["student_id"];

    try {
        require_once "connection.inc.php";

        // Optionally, use current date/time
        $date_absence = date('Y-m-d');

        // Insert absence record
        $sql = "INSERT INTO absences (student_id, date_absence) VALUES (:student_id, :date_absence)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":student_id", $student_id);
        $stmt->bindParam(":date_absence", $date_absence);
        $stmt->execute();

        // Cleanup
        $pdo = null;
        $stmt = null;

        // Redirect back to the page that submitted the form
        header("Location: ../gestion.php"); // replace with your actual page
        exit;

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    $_SESSION["absence_message"] = 1; // Invalid submission
    header("Location: ../somepage.php");
    exit;
}