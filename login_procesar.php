<?php
session_start();

$conexion = new mysqli("localhost", "root", "", "bookflow");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$email = $_POST['email'] ?? "";
$password = $_POST['password'] ?? "";

// Consulta
$sql = "SELECT * FROM usuarios WHERE email='$email' LIMIT 1";
$result = $conexion->query($sql);

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();

    if ($row['password'] === $password) {

        $_SESSION['usuario_id'] = $row['id'];
        $_SESSION['usuario_nombre'] = $row['nombre'];
        $_SESSION['usuario_email'] = $row['email'];

        if ($email === "admin@admin.com" || $password === "123") {
            header("Location: admin.html");
            exit();
        }

        header("Location: libreria.php");
        exit();
    }
}

// Si falla:
header("Location: login.php?error=1");
exit();
?>
