<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $correo = $_POST['correo'];
    $nuevaContrasena = $_POST['Ncontrasena'];

    // Datos de conexión a la base de datos
    $host = 'ns1.hostingmax.net';
    $dbname = 'interspace_pagina_web';
    $username = 'interspace_interspace';
    $password = 'Charly10072023';

    // Conectar a la base de datos
    $conexion = new mysqli($host, $username, $password, $dbname);
    if ($conexion->connect_error) {
        die('Error en la conexión: ' . $conexion->connect_error);
    }

    // Verificar si el correo existe en la base de datos
    $sql = "SELECT * FROM Usuarios WHERE correo = '$correo'";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        // El correo existe en la base de datos, actualizar la contraseña
        $hashedContrasena = password_hash($nuevaContrasena, PASSWORD_DEFAULT);
        $updateSql = "UPDATE Usuarios SET contrasena = '$hashedContrasena' WHERE correo = '$correo'";
        
        if ($conexion->query($updateSql) === true) {
            // Contraseña actualizada con éxito
            ?>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>
            <script>
                window.addEventListener("DOMContentLoaded", () => {
                    Swal.fire({
                        title: "Contraseña actualizada con éxito",
                        text: "Puedes iniciar sesión con tu nueva contraseña.",
                        icon: "success",
                        confirmButtonText: "Iniciar Sesión"
                    }).then(() => {
                        window.location.href = "Login.html";
                    });
                });
            </script>
            <?php
        } else {
            // Error al actualizar la contraseña

                ?>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>
                <script>
                    window.addEventListener("DOMContentLoaded", () => {
                        Swal.fire({
                        title: "Error al actualizar la contraseña",
                        text: "Ha ocurrido un error al intentar actualizar la contraseña.",
                        icon: "error",
                        confirmButtonText: "Intentar de nuevo"
                    }).then(() => {
                        window.location.href = "OlvidoSuContrasena.html";
                    });
                 });
                </script>
                <?php
        }
    } else {
        // El correo no existe en la base de datos

            ?>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>
                <script>
                    window.addEventListener("DOMContentLoaded", () => {
                        Swal.fire({
                    title: "Correo electrónico no encontrado",
                    text: "El correo electrónico no existe en la base de datos.",
                    icon: "warning",
                    confirmButtonText: "Intentar de nuevo"
                    }).then(() => {
                    window.location.href = "OlvidoSuContrasena.html";
                    });
                });
                </script>
                <?php
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
}
?>
