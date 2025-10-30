<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDatos = "biblioteca";

$conexion = new mysqli($servidor, $usuario, $clave, $baseDatos);

if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}
?>
