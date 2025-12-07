<?php

$conn = new mysqli("localhost", "root", "", "bookflow");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$nombre    = $_POST['nombre'] ?? "";
$email     = $_POST['email'] ?? "";
$password  = $_POST['password'] ?? "";
$password2 = $_POST['password2'] ?? "";

// Validación básica
if (empty($nombre) || empty($email) || empty($password) || empty($password2)) {
    die("Todos los campos son obligatorios. <a href='registro.html'>Volver</a>");
}

if ($password !== $password2) {
    die("Las contraseñas no coinciden. <a href='registro.html'>Volver</a>");
}

// Verificar que no exista el correo
$existe = $conn->query("SELECT id FROM usuarios WHERE email = '$email' LIMIT 1");

if ($existe->num_rows > 0) {
    die("Este correo ya se encuentra registrado. <a href='login.html'>Iniciar sesión</a>");
}

// Insertar en la base de datos
$sql = "INSERT INTO usuarios (nombre, email, password)
        VALUES ('$nombre', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Usuario registrado correctamente.<br><a href='login.html'>Iniciar sesión</a>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
