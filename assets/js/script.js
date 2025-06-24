document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("#contact form");

    form.addEventListener("submit", function (e) {
      e.preventDefault(); // Evita que se recargue la página

      // Obtener valores
      const nombre = document.getElementById("nombre").value.trim();
      const email = document.getElementById("email").value.trim();
      const telefono = document.getElementById("telefono").value.trim();
      const mensaje = document.getElementById("mensaje").value.trim();

      // Validar campos vacíos
      if (!nombre || !email || !telefono || !mensaje) {
        alert("Por favor, completa todos los campos.");
        return;
      }

      // Validar formato de email básico
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        alert("Por favor, ingresa un email válido.");
        return;
      }

      // Mostrar mensaje de éxito
      alert("¡Gracias por contactarnos, " + nombre + "! Pronto te responderemos.");

      // Reiniciar formulario
      form.reset();
    });
});

