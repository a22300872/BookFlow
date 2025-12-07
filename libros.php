<?php
session_start();
header('Content-Type: application/json');

// Configuración de la base de datos
$host = "localhost";
$db   = "bookflow";
$user = "root"; // cambia si es otro usuario
$pass = "";     // cambia si tiene contraseña

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT id, titulo, autor, isbn, descripcion, imagen FROM libros");
    $libros = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($libros);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
