<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BookFlow | Login</title>

  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="css.css">
</head>
<body>

<header class="bg-dark text-white p-3 shadow-sm header-fixed">
  <div class="container d-flex justify-content-between align-items-center">
    <h3 class="m-0">BookFlow</h3>
    <button class="btn btn-outline-light btnAbrir" id="openInfo">Info</button>
  </div>
</header>

<section class="container mt-5 mb-5">
  <div class="row justify-content-center">
    <div class="col-md-5">

      <div class="card p-4 shadow-lg login-card">

        <h4 class="mb-3 text-center fw-bold">Iniciar Sesión</h4>

        <?php if(isset($_GET['error'])): ?>
        <div class="alert alert-danger text-center">
          Correo o contraseña incorrectos
        </div>
        <?php endif; ?>

        <form id="loginForm" method="POST" action="login_procesar.php">

          <div class="mb-3">
            <label class="form-label fw-bold">Correo electrónico</label>
            <input type="email" class="form-control form-control-lg" id="email" name="email" required>
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">Contraseña</label>
            <div class="input-group">
              <input type="password" class="form-control form-control-lg" id="password" name="password" required>
              <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                👁️
              </button>
            </div>
          </div>

          <button type="submit" class="btn btn-danger w-100 btn-lg mt-3">Entrar</button>

          <p class="text-center mt-3 mb-0">
            ¿No tienes cuenta?
            <a href="registro.html" class="link-danger fw-semibold">Crear cuenta</a>
          </p>

        </form>

      </div>
    </div>
  </div>
</section>

<div class="modal" id="miModal">
  <div class="modal-contenido">
    <span class="cerrar" id="cerrar">&times;</span>

    <h4 class="mb-2">Bienvenido a BookFlow</h4>
    <p class="text-muted">
      Gestiona tus libros, préstamos y usuarios de manera sencilla desde esta plataforma.
    </p>

    <button class="btnAceptar" id="aceptarBtn">Entendido</button>
  </div>
</div>

<script>
function togglePassword() {
  const field = document.getElementById('password');
  field.type = field.type === "password" ? "text" : "password";
}

let modal = document.getElementById("miModal");
let openBtn = document.getElementById("openInfo");
let closeBtn = document.getElementById("cerrar");
let aceptarBtn = document.getElementById("aceptarBtn");

openBtn.onclick = () => modal.style.display = "flex";
closeBtn.onclick = () => modal.style.display = "none";
aceptarBtn.onclick = () => modal.style.display = "none";

window.onclick = (e) => {
  if (e.target === modal) modal.style.display = "none";
}
</script>

</body>
</html>
