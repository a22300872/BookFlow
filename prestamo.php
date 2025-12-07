<?php
session_start();
require "conexion.php";

// Obtener todos los préstamos
$sql = "SELECT p.id, u.nombre AS usuario, l.titulo AS libro, p.fecha_solicitud 
        FROM prestamos p
        INNER JOIN usuarios u ON u.id = p.usuario_id
        INNER JOIN libros l ON l.id = p.libro_id
        ORDER BY p.fecha_solicitud DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Préstamos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container py-4">
    <h2 class="mb-4">Préstamos registrados</h2>

    <!-- Tabla de Préstamos -->
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
              
                <th>Usuario</th>
                <th>Libro</th>
                <th>Fecha Solicitud</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['usuario'] ?></td>
                    <td><?= $row['libro'] ?></td>
                    <td><?= $row['fecha_solicitud'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <hr>

    

</div>


<!-- MODAL PARA PEDIR LIBRO -->

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>

</body>
</html>








