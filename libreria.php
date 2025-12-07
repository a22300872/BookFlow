<?php
session_start();

// Si NO hay sesión → mandar al login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php?error=not_logged");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$usuario_nombre = $_SESSION['usuario_nombre'] ?? "Sin nombre";
$usuario_email = $_SESSION['usuario_email'] ?? "";

// Admin automático si el correo coincide
$es_admin = ($usuario_email === "admin@bookflow.com");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookFlow | Librería</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- Tus estilos (si tienes) -->
    <link rel="stylesheet" href="styles.css">

    <!-- Iconos (opcional pero queda mamalón) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body class="bg-light">

<!-- ==========================
         NAVBAR
========================== -->
<nav class="navbar navbar-dark bg-dark px-3">
    <span class="navbar-brand">BookFlow</span>

    <div class="d-flex align-items-center text-white">

        <span class="me-3">Hola, <?php echo htmlspecialchars($usuario_nombre); ?> 👋</span>

        <!-- BOTÓN: Registro -->
        <a href="usuario.php" class="btn btn-primary btn-sm me-3">
            Usuario
        </a>

        <!-- BOTÓN: Préstamos -->
        <a href="prestamo.php" class="btn btn-info btn-sm me-3">
            Préstamos
        </a>

        <!-- BOTÓN: Admin -->
        <?php if ($es_admin): ?>
            <a href="admin_agregar.php" class="btn btn-warning btn-sm me-3">
                Modo Admin ⭐
            </a>
        <?php endif; ?>

        <!-- Cerrar sesión -->
        <a href="login.php" class="btn btn-danger btn-sm">Cerrar sesión</a>
    </div>
</nav>

<!-- ==========================
           CONTENIDO
========================== -->
<div class="container mt-4">

    <h2 class="mb-3">Catálogo de libros</h2>

    <input type="text" id="buscador" class="form-control mb-3" placeholder="Buscar libros...">

    <div class="row" id="contenedorLibros"></div>
</div>

<!-- ==========================
        MODAL DE PRÉSTAMO
========================== -->
<div class="modal fade" id="modalIntercambio" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Pedir libro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <p>Vas a solicitar el libro:</p>
        <h4 id="tituloLibro" class="text-primary"></h4>

        <input type="hidden" id="idLibroSeleccionado">
        <input type="hidden" id="usuario_id" value="<?php echo $usuario_id; ?>">

        <div id="resultado" class="mt-2 text-success"></div>
      </div>

      <div class="modal-footer">
        <button id="btnEnviarPrestamo" class="btn btn-primary w-100">
            Confirmar préstamo
        </button>
      </div>

    </div>
  </div>
</div>

<!-- Scripts -->
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
