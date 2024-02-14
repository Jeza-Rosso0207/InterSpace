<?php
session_start(); // Iniciar la sesión

if (isset($_SESSION['correo'])) {
    $correoUsuario = $_SESSION['correo']; // Recuperar el correo del usuario
} else {
    // Redirigir si no hay sesión iniciada
    header("Location: Login.html");
    exit(); // Asegura que el script se detenga después de redirigir
}