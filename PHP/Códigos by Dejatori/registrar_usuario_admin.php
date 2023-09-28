<?php

// Incluir archivo de conexión y clase Auth
require_once 'clase_conexion.php';
require_once 'clase_auth.php';

// Instancia de conexión y autenticación
$conexion = new Conexion();
$Auth = new Auth($conexion);

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recuperar los datos del formulario
    $usuario = $_POST["usuario"];
    $correo = $_POST["correo"];
    $clave = $_POST["clave"];
    $tipo_usuario = $_POST["tipo_usuario"];

    // Insertar el nuevo usuario en la base de datos
    if ($Auth->registrar_administrador($usuario, $clave, $correo, $tipo_usuario)) {
        // Redirigir al usuario a la página de inicio de sesión
        header("location: login.php");
        exit;
    } else {
        echo "Error al registrar usuario";
    }
}