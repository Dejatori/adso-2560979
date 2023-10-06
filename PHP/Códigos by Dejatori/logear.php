<?php
(session_status() === PHP_SESSION_NONE ? session_start() : ''); // Iniciar la sesión de PHP si no está iniciada

// Incluir archivo de conexión, clase Auth y archivo de funciones
require_once 'clase_conexion.php';
require_once 'clase_auth.php';
require_once 'funciones.php';

// Instancia de conexión y autenticación
$conexion = new Conexion();
$Auth = new Auth($conexion);

$correo = $_POST['correo'];
$clave = $_POST['clave'];

// Función para crear una cookie
if (isset($_POST['correo']) && isset($_POST['clave'])) {
    // Verificar si es un administrador o parte del equipo de soporte
    $es_admin = $Auth->es_administrador($correo);
    $es_soporte = $Auth->es_soporte($correo);

    if ($es_admin && $Auth->logear_administrador($correo, $clave)) {
        // Si el botón "Recordarme" está marcado, crear una cookie
        recuerdame($correo, $clave);
        header('Location: admin');
    } elseif ($es_soporte && $Auth->logear_soporte($correo, $clave)) {
        // Si el botón "Recordarme" está marcado, crear una cookie
        recuerdame($correo, $clave);
        header('Location: soporte');
    } elseif ($Auth->logear_usuario($correo, $clave)) {
        // Si el botón "Recordarme" está marcado, crear una cookie
        recuerdame($correo, $clave);
        header('Location: inicio.php');
    } else {
        $_SESSION['login_error'] = "<div class='alert alert-danger'>
                                        <strong>El correo electrónico o la contraseña son incorrectos. Por favor, inténtalo de nuevo.</strong>.
                                    </div>";
        header('Location: login.php');
    }
} else {
    $_SESSION['login_error'] = "<div class='alert alert-danger'>
                                    <strong>El correo electrónico o la contraseña son incorrectos. Por favor, inténtalo de nuevo.</strong>.
                                </div>";
    header('Location: login.php');
}