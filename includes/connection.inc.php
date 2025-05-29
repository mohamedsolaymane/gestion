<?php

$dsn="mysql:host=localhost;dbname=gestione";
$username="root";
$password="";

try {
    $pdo=new PDO($dsn,$username,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    echo "connection failed" . $e->getMessage();
}