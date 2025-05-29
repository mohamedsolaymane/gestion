<?php
require_once "connection.inc.php";

if (isset($_GET['student_id'])) {
    $id = $_GET['student_id'];

    $sql = "SELECT COUNT(*) FROM absence 
            WHERE student_id = :id 
            AND MONTH(date_absence) = MONTH(CURDATE()) 
            AND YEAR(date_absence) = YEAR(CURDATE())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":id" => $id]);
    $count = $stmt->fetchColumn();

    echo json_encode(["count" => $count]);
}