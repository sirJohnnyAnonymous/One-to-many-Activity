<?php
session_start();
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'tayloact';
$dsn = "mysql:host=$host;dbname={$dbname};charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->exec("SET time_zone = '+08:00'");
} catch (PDOException $e) {
    http_response_code(500);
    die('Database connection failed: ' . $e->getMessage());
}
?>
