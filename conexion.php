<?php
$servername = "localhost"; // Siempre localhost si estás usando XAMPP
$username = "root";        // Usuario por defecto en XAMPP
$password = "";            // Contraseña por defecto en XAMPP es vacía
$dbname = "bookflow";    // <- Aquí pones el nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Revisar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
