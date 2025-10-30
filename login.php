<?php
header("Content-Type: application/json");
include("conexion.php"); // este archivo tendrá tus datos de conexión

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

$sql = "SELECT * FROM usuarios WHERE correo='$correo' AND contrasena='$contrasena'";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    echo json_encode(["success" => true, "mensaje" => "Inicio de sesión correcto"]);
} else {
    echo json_encode(["success" => false, "mensaje" => "Correo o contraseña incorrectos"]);
}
?>

