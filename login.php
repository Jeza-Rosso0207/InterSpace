<?php
session_start(); // Iniciar la sesión

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Datos para la conexión con la base de datos
    $host = 'ns1.hostingmax.net'; 
    $dbname = 'interspace_pagina_web'; 
    $username = 'interspace_interspace';
    $password = 'Charly10072023'; 

    // Conectar a la base de datos utilizando mysqli
    $conexion = new mysqli($host, $username, $password, $dbname);
    if ($conexion->connect_error) {
        die('Error en la conexión: ' . $conexion->connect_error);
    }

    // Verificar la información de inicio de sesión en la base de datos
    $sql = "SELECT * FROM Usuarios WHERE correo = '$correo'";
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($contrasena, $user['contrasena'])) {
            // La información de inicio de sesión es correcta, establecer una variable de sesión
            $_SESSION['usuario'] = $user['correo'];

            // Mostrar SweetAlert de éxito para inicio de sesión correcto
            mostrarSweetAlert("Éxito", "Inicio de sesión exitoso", "success", "MisCompras.html");
        } else {
            // La contraseña es incorrecta, mostrar SweetAlert de error para inicio de sesión incorrecto
            mostrarSweetAlert("Error", "Contraseña incorrecta", "error", "Login.html");
        }
    } else {
        // El usuario no existe, mostrar SweetAlert de error
        mostrarSweetAlert("Error", "El usuario no existe, ¿quieres crear una cuenta?", "error", "Login.html");
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
}

// Función para mostrar un SweetAlert con opciones
function mostrarSweetAlert($title, $text, $icon, $redirect) {
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>
    <script>
        window.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "<?php echo $title; ?>",
                text: "<?php echo $text; ?>",
                icon: "<?php echo $icon; ?>",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ir a <?php echo $redirect === 'MisCompras.html' ? 'Mis Compras' : 'Login'; ?>",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirigir al usuario a la página correspondiente
                    window.location.href = "<?php echo $redirect; ?>";
                } else {
                    // El usuario cancela, redirigirlo a la página de inicio de sesión
                    window.location.href = "index.html";
                }
            });
        });
    </script>
    <?php
}
?>
