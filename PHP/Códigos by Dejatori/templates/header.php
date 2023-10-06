<?php
require_once 'clase_conexion.php';
require_once 'clase_auth.php';

// Verificar los datos de sesión del usuario
/**
 * @return array
 */
function datosUsuario(): array
{
    $usuario_id = $_SESSION['usuario_id'];
    $nombre = $_SESSION['nombre'];
    $correo = $_SESSION['correo'];
    $apellido = $_SESSION['apellido'];
    $tipo_doc_identidad = $_SESSION['tipo_doc_identidad'];
    $doc_identidad = $_SESSION['doc_identidad'];
    $fecha_nacimiento = $_SESSION['fecha_nacimiento'];
    $tipo_usuario = $_SESSION['tipo_usuario'];
    return array($usuario_id, $nombre, $correo, $apellido, $tipo_doc_identidad, $doc_identidad, $fecha_nacimiento, $tipo_usuario);
}

?>

<?php

// Función para verificar si el usuario es válido
function esUsuarioValido(): bool
{
    return (isset($_SESSION['tipo_usuario']) && (
        $_SESSION['tipo_usuario'] == 'Usuario' ||
            $_SESSION['tipo_usuario'] == 'Usuario_verificado'
    ));
}

// Función para redirigir al inicio de sesión
#[NoReturn] function redireccionarInicioSesion(): void
{
    header('Location: index.php');
    exit();
}

// Función para cerrar la sesión
function cerrarSesion(): void
{
    session_unset();
    session_destroy();
}
?>
<body>
    <nav class="navbar">
        <div class="container"><a class="navbar-brand" href="inicio.php">LOGIN DE PRUEBA</a>
            <div>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="inicio.php">INICIO</a></li>
                    <li class="nav-item"><a class="nav-link" href="registro.php">REGISTRO</a></li>
                    <li class="nav-item"><a class="nav-link" href="encriptar_claves.php">ENCRIPTAR CLAVES</a></li>
                    <li class="nav-item"><a class="nav-link" href="clase_conexion.php">CONEXIÓN DE LA BASE DE DATOS</a></li>
                    <li class="nav-item"><a class="nav-link" href="cerrar_sesion.php">CERRAR SESIÓN</a></li>
                </ul>
            </div>
        </div>
    </nav>
