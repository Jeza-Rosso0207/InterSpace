document.addEventListener("DOMContentLoaded", function() {
  //Precios:
  let mostrador = document.querySelector(".mostrador");
  let seleccion = document.querySelector(".seleccion");
  let imgSeleccionada = document.querySelector(".info img");
  let modeloSeleccionado = document.querySelector(".info h2");
  let descripSeleccionada = document.querySelector(".info p");
  // Traer el precio
  let precioSeleccionado = document.querySelector(".info .precio");

  // Cuantos pasajeros son:
  var viajerosSelect = document.getElementById("viajeros-select");

  function cargarElemento(item) {
    quitarBordes();
    mostrador.style.width = "60%";
    seleccion.style.width = "40%";
    seleccion.style.opacity = "1";
    item.style.border = "2px solid red";

    imgSeleccionada.src = item.querySelector("img").src;
    modeloSeleccionado.innerHTML = item.querySelector(".descripcion").innerHTML;
    var descripcion = item.getAttribute("data-comentario");
    document.getElementById("descripcion").textContent = descripcion;
    var viajerosSelect = document.getElementById("viajeros-select");
    var precio = parseFloat(item.querySelector(".precio").textContent.replace("$", "").replace(",", ""));
    precioSeleccionado.dataset.precio = precio;
    precioSeleccionado.innerHTML = "$" + precio.toFixed(2);
    
    reiniciarSeleccion();
  }

  function actualizarPrecio() {
    var selectedSize = parseInt(viajerosSelect.value);
    var precio = parseFloat(precioSeleccionado.dataset.precio);

    if (isNaN(precio)) {
      return;
    }

    var precioTotal = precio * selectedSize;

    precioSeleccionado.innerHTML = "$" + precioTotal.toFixed(2);
  }

  function cerrar() {
    mostrador.style.width = "100%";
    seleccion.style.width = "0%";
    seleccion.style.opacity = "0";
    quitarBordes();
  }

  function quitarBordes() {
    var items = document.querySelectorAll(".mostrador .fila .item");
    for (var i = 0; i < items.length; i++) {
      items[i].style.border = "none";
    }
  }
  
  function reiniciarSeleccion() {
    viajerosSelect.value = 0;
  }

  var items = document.querySelectorAll(".mostrador .fila .item");
  for (var i = 0; i < items.length; i++) {
    items[i].addEventListener("click", function() {
      cargarElemento(this);
    });
  }

  var cerrarBtn = document.querySelector(".cerrar");
  cerrarBtn.addEventListener("click", cerrar);

  viajerosSelect.addEventListener("change", actualizarPrecio);


  //Titulo:
  const subrayado = document.getElementById("subrayado");
  const titulo = document.getElementById("titulo");
  const tituloHidden = document.getElementById("titulo-hidden");

  // Espera un momento antes de mostrar el título y el subrayado
  setTimeout(function() {
      subrayado.style.transform = "scaleX(0)"; // Ocultar el subrayado
      titulo.style.opacity = "1"; // Mostrar el título
      tituloHidden.style.opacity = "0"; // Ocultar el título oculto
  }, 1000); // Espera 1 segundo (puedes ajustar el tiempo según tus preferencias)

  //Verificar sesion 
  const misComprasButton = document.getElementById("misComprasButton");

  misComprasButton.addEventListener("click", function (e) {
      e.preventDefault(); // Evita el comportamiento predeterminado del enlace

      // Verifica si el usuario está autenticado
      fetch("verificar_sesion.php")
          .then(response => response.json())
          .then(data => {
              if (data.autenticado) {
                  // El usuario ya ha iniciado sesión, redirigir a Mis Compras
                  window.location.href = "MisCompras.php";
              } else {
                  // El usuario no ha iniciado sesión, abrir la página de inicio de sesión
                  window.location.href = "Login.html";
              }
          })
          .catch(error => {
              console.error("Error al verificar la sesión:", error);
          });
  });



 // Grafico
 /*var ctx = document.getElementById('miGrafico').getContext('2d');
 var data = {
     labels: ['Luna', 'Marte', 'Jupiter', 'Saturno', 'Urano', ' Neptuno', 'Pluton', 'Antares'],
     datasets: [{
         label: 'Ventas Mensuales',
         data: [12, 19, 3, 5, 2, 3, 7, 8],
         backgroundColor: [
             'rgba(255, 99, 132, 0.2)',
             'rgba(54, 162, 235, 0.2)',
             'rgba(255, 206, 86, 0.2)',
             'rgba(75, 192, 192, 0.2)',
             'rgba(153, 102, 255, 0.2)'
         ],
         borderColor: [
             'rgba(255, 99, 132, 1)',
             'rgba(54, 162, 235, 1)',
             'rgba(255, 206, 86, 1)',
             'rgba(75, 192, 192, 1)',
             'rgba(153, 102, 255, 1)'
         ],
         borderWidth: 1
     }]
 };
 var myChart = new Chart(ctx, {
     type: 'bar', // Tipo de gráfico (puedes usar 'bar', 'line', etc.)
     data: data,
     options: {
         scales: {
             y: {
                 beginAtZero: true
             }
         }
     }
 });*/

});
