// ===============================
//  CARGAR LIBROS DESDE EL BACKEND
// ===============================

function cargarLibros() {
  fetch("libros.php")
    .then(r => r.json())
    .then(data => {
      const cont = document.getElementById("contenedorLibros");
      cont.innerHTML = "";

      data.forEach(libro => {
        const tituloSafe = libro.titulo.replace(/"/g, '&quot;');

        cont.innerHTML += `
          <div class="col-md-4 d-flex">
            <div class="card shadow-sm p-3 book-card">
              <h5>${libro.titulo}</h5>
              <p class="text-muted mb-1">${libro.autor}</p>
              <h6 class="text-muted small mb-1">ISBN: <span>${libro.isbn}</span></h6>
              <p class="small">${libro.descripcion}</p>
              <img style="height: 600px;" class="mb-2" src="${libro.imagen}" />
              <button class="btn btn-outline-danger btn-sm w-100 btn-intercambio"
                data-bs-toggle="modal" data-bs-target="#modalIntercambio"
                onclick="seleccionarLibro('${tituloSafe}', '${libro.id}')">
                Solicitar libro
              </button>
            </div>
          </div>
        `;
      });

      activarBuscador();
    })
    .catch(err => console.error("Error cargando libros:", err));
}

document.addEventListener("DOMContentLoaded", () => {
  const boton = document.getElementById("btnEnviarPrestamo");

  if (!boton) {
    console.error("No existe el botón btnPedir");
    return;
  }

  boton.addEventListener("click", () => {
    console.log("Botón presionado");

    const usuario_id = document.getElementById("usuario_id").value;
    const libro_id   = document.getElementById("idLibroSeleccionado").value;

    console.log("Datos a enviar:", { usuario_id, libro_id });

    fetch("prestamo.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `usuario_id=${usuario_id}&libro_id=${libro_id}`
    })
      .then(r => r.text())
      .then(txt => {
        
        document.getElementById("resultado").innerText = txt;
      })
      .catch(err => console.error("Error en fetch:", err));
  });
});




// ====================================
//  FUNCIÓN PARA PASAR DATA AL MODAL
// ====================================

function seleccionarLibro(titulo, id) {
  document.getElementById("tituloLibro").innerText = titulo;
  document.getElementById("idLibroSeleccionado").value = id;
}


// ===============================
//  BUSCADOR EN VIVO
// ===============================

document.addEventListener('DOMContentLoaded', function () {
  activarBuscador();
});

function activarBuscador() {
  const input = document.getElementById("buscador");
  if (!input) return;

  input.addEventListener("input", (e) => {
    const filtro = e.target.value.toLowerCase();

    document.querySelectorAll(".book-card").forEach(card => {
      const tituloEl = card.querySelector("h5");
      const autorEl = card.querySelector("p");
      const isbnEl = card.querySelector("h6 a");

      if (!tituloEl || !autorEl || !isbnEl) return;

      const titulo = tituloEl.innerText.toLowerCase();
      const autor = autorEl.innerText.toLowerCase();
      const isbn = isbnEl.innerText.toLowerCase();

      const ok =
        titulo.includes(filtro) ||
        autor.includes(filtro) ||
        isbn.includes(filtro);

      // Ocultamos la columna completa, no solo la card
      card.parentElement.style.display = ok ? "block" : "none";
    });
  });
}



// ===============================
//  LOGIN (BACKEND)
// ===============================

function activarLogin() {
  const form = document.getElementById("loginForm");
  if (!form) return;

  form.addEventListener("submit", e => {
    e.preventDefault();

    let datos = new FormData(form);

    fetch("login.php", {
      method: "POST",
      body: datos
    })
      .then(r => r.text())
      .then(res => {
        if (res.trim() === "success") {
          window.location.href = "libreria.php";
        } else {
          alert("Datos incorrectos.");
        }
      })
      .catch(err => console.error("Error en login:", err));
  });
}


// =========================================
//  AUTO-INIT
// =========================================

document.addEventListener("DOMContentLoaded", () => {
  if (document.getElementById("contenedorLibros")) cargarLibros();
  if (document.getElementById("loginForm")) activarLogin();
});

