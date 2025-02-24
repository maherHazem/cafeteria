<?php
$dsn='mysql:host=localhost;dbname=cafeteria';
$databaseUser = "pfae_cafeteria";
$databasePassword = "pfae_url";
try {
    $pdo = new PDO($dsn, $databaseUser, $databasePassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("No se pudo conectar a la base de datos:".$e->getMessage());
}
?>