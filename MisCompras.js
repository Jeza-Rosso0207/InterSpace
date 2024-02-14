// Supongamos que el usuario ha iniciado sesión y su ID está almacenado en la variable userID
// Supongamos también que el ID del producto que deseas verificar es productoID

// Hacer una solicitud AJAX al servidor para obtener el número de compras del producto
fetch('obtener_numero_compras.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ userID: userID, productoID: productoID }),
  })
  .then(response => response.json())
  .then(data => {
    // Aquí puedes manejar los datos recibidos, por ejemplo, mostrar el número de compras en la interfaz
  })
  .catch(error => {
    console.error('Error:', error);
  });
  