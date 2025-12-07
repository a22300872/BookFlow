<?php
session_start();
require "conexion.php";

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    // Si alguien entra por URL → no debe salir error, solo no hacer nada.
    exit("Backend listo.");
}

if (empty($_POST['usuario_id']) || empty($_POST['libro_id'])) {
    exit("Error: datos incompletos");
}

$usuario_id = $_POST['usuario_id'];
$libro_id   = $_POST['libro_id'];

$stmt = $conn->prepare("INSERT INTO prestamos (usuario_id, libro_id, fecha_solicitud) VALUES (?, ?, NOW())");
$stmt->bind_param("ii", $usuario_id, $libro_id);

if ($stmt->execute()) {
    echo "Préstamo registrado correctamente ✔️";
} else {
    echo "Error al registrar el préstamo ❌ " . $stmt->error;
}
