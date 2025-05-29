<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["student_id"])) {
        $studentId = intval($_POST["student_id"]);
        $dateAbsence = date("Y-m-d"); // Automatically use today's date

        try {
            require_once "connection.inc.php";

            // Optional: check if already marked absent today
            $checkSql = "SELECT COUNT(*) FROM absence WHERE student_id = :student_id AND date_absence = :date_absence";
            $stmtCheck = $pdo->prepare($checkSql);
            $stmtCheck->execute([
                ":student_id" => $studentId,
                ":date_absence" => $dateAbsence
            ]);
            $exists = $stmtCheck->fetchColumn();

            if ($exists > 0) {
                $_SESSION["absence_status"] = "already_exists";
            } else {
                $insertSql = "INSERT INTO absence (student_id, date_absence) VALUES (:student_id, :date_absence)";
                $stmt = $pdo->prepare($insertSql);
                $stmt->execute([
                    ":student_id" => $studentId,
                    ":date_absence" => $dateAbsence
                ]);
                $_SESSION["absence_status"] = "success";
            }

            // Cleanup
            $pdo = null;
            $stmt = null;
            $stmtCheck = null;

            header("Location: ../gestion.php");
            exit();
        } catch (PDOException $e) {
            die("Database error: " . $e->getMessage());
        }
    } else {
        $_SESSION["absence_status"] = "missing_fields";
        header("Location: ../gestion.php");
        exit();
    }
} else {
    $_SESSION["absence_status"] = "invalid_request";
    header("Location: ../gestion.php");
    exit();
}
