<?php
$conexion = new mysqli("localhost", "root", "", "bookflow");
$conexion->set_charset("utf8");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Campos del form
$titulo = $_POST["titulo"] ?? "";
$autor = $_POST["autor"] ?? "";
$isbn = $_POST["isbn"] ?? "";
$descripcion = $_POST["descripcion"] ?? "";

// Guardar imagen
$imagenURL = "";

if (!empty($_FILES["imgFile"]["name"])) {
    $nombreTmp = $_FILES["imgFile"]["tmp_name"];
    $nombreDestino = "img_" . time() . "_" . $_FILES["imgFile"]["name"];

    if (move_uploaded_file($nombreTmp, "../img/" . $nombreDestino)) {
        $imagenURL = "img/" . $nombreDestino;
    }
}

$sql = $conexion->prepare("INSERT INTO libros (titulo, autor, isbn, descripcion, imagen) VALUES (?, ?, ?, ?, ?)");
$sql->bind_param("sssss", $titulo, $autor, $isbn, $descripcion, $imagenURL);

if ($sql->execute()) {
    echo "<div class='alert alert-success'>Libro agregado correctamente.</div>";
} else {
    echo "<div class='alert alert-danger'>Error: " . $conexion->error . "</div>";
}

$conexion->close();
?>
