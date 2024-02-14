<?php
session_start(); // Iniciar la sesión

// Verificar si el usuario está autenticado
$autenticado = isset($_SESSION['usuario']);

// Devuelve el estado de autenticación como respuesta JSON
echo json_encode(["autenticado" => $autenticado]);
?>
