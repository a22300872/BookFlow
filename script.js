document.addEventListener('DOMContentLoaded', () => {
  // === BÚSQUEDA DE LIBROS ===
  const buscador = document.getElementById('buscador');
  const contenedor = document.querySelector('.row');
  const tarjetas = Array.from(document.querySelectorAll('.book-card'));

  if (buscador) {
    buscador.addEventListener('input', () => {
      const texto = buscador.value.toLowerCase();

      const coincidencias = [];
      const noCoinciden = [];

      tarjetas.forEach(tarjeta => {
        const titulo = tarjeta.querySelector('h5').innerText.toLowerCase();
        const autor = tarjeta.querySelector('p.text-muted').innerText.toLowerCase();
        const isbnEl = tarjeta.querySelector('h6 a');
        const num = isbnEl ? isbnEl.innerText.toLowerCase() : '';

        if (titulo.includes(texto) || autor.includes(texto) || num.includes(texto)) {
          tarjeta.style.display = 'flex';
          coincidencias.push(tarjeta.parentElement);
        } else {
          tarjeta.style.display = 'none';
          noCoinciden.push(tarjeta.parentElement);
        }
      });

      // Reordenar para que coincidencias aparezcan primero
      coincidencias.concat(noCoinciden).forEach(el => contenedor.appendChild(el));
    });
  }

  // === MODAL DE INTERCAMBIO ===
  document.querySelectorAll('.btn-intercambio').forEach(boton => {
    boton.addEventListener('click', () => {
      const titulo = boton.parentElement.querySelector('h5').innerText;
      document.getElementById('nombreLibroModal').innerText = titulo;
    });
  });

  // === LOGIN (si existe formulario) ===
  const loginForm = document.getElementById('loginForm');
  if (loginForm) {
    loginForm.addEventListener('submit', function(e) {
      e.preventDefault();

      const correo = document.getElementById('email').value.trim();
      const contrasena = document.getElementById('password').value.trim();
      if (correo === '' || contrasena === '') {
        alert('Por favor, completa todos los campos.');
        return;
      }

      fetch('http://localhost/biblioteca/login.php', {
        method: 'POST',
        body: new URLSearchParams({ correo, contrasena }),
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          alert('Inicio de sesión exitoso');
          window.location.href = "inicio.html";
        } else {
          alert('Error: ' + data.mensaje);
        }
      })
      .catch(err => console.error(err));
    });
  }
});
