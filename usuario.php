<?php
session_start();

// Si no hay sesión → mandar a login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html");
    exit();
}

// Conexión
$conn = new mysqli("localhost", "root", "", "bookflow");
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$id = $_SESSION['usuario_id'];

// Traer datos del usuario
$sql = "SELECT * FROM usuarios WHERE id = $id";
$result = $conn->query($sql);
$usuario = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BookFlow | Usuario</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <style>
    body { background-color: #f7f8fc; font-family: 'Poppins', sans-serif; }
    header { background-color: #212529; color: #fff; padding: 1rem 0; }
    .card { border-radius: 12px; }
  </style>
</head>
<body>

<header>
  <div class="container d-flex justify-content-between align-items-center">
    <h3 class="m-0">BookFlow</h3>
    <nav>
      <a href="libreria.php" class="text-white text-decoration-none">Inicio</a>
      <a href="usuario.php" class="text-white text-decoration-none ms-4">
        <i class="bi bi-gear-fill"></i>
      </a>
    </nav>
  </div>
</header>

<div class="container mt-5">

  <!-- TARJETA DEL USUARIO -->
  <div class="card p-4 shadow-sm mx-auto" style="max-width:600px;">
    <div class="d-flex flex-wrap align-items-center" style="gap: 20px;">
      
      <img src="https://imgs.search.brave.com/rebjoO0CEvovIFWSy80LoKzdkmQQu9XuPGtLjdMTPCs/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9pLnBp/bmltZy5jb20vb3Jp/Z2luYWxzL2JkLzFj/L2M3L2JkMWNjNzUx/ODY1YzY3ZGU2OTUy/MTZkYTA0NTU3OWQ1/LmpwZw"
           class="img-fluid rounded-circle"
           style="width:120px; height:120px; object-fit:cover;">

      <div>
        <h5><?php echo $usuario['nombre']; ?></h5>
        <p class="m-0">Correo: <?php echo $usuario['email']; ?></p>
      </div>
    </div>

    <div class="text-center mt-4">
      <a href="prestamo.php" class="btn btn-outline-danger" style="min-width: 300px;">
        Información de préstamos
      </a>
    </div>
  </div>

</div>

</body>
</html>
