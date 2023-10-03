<?php
session_start();
// Verificar que el usuario sea Desarrollador o Administrador CEO
if ($_SESSION['tipo_usuario'] == 'Desarrollador' || $_SESSION['tipo_usuario'] == 'Administrador CEO') {
    // Obtener los datos de la sesión
    $usuario_id = $_SESSION['usuario_id'];
    $nombre = $_SESSION['nombre'];
    $correo = $_SESSION['correo'];

    // Mostrar información específica
} else {
    // Si el usuario no es Desarrollador ni Administrador CEO, mostrar un mensaje de error
    header('location: 403.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> <!-- Codificación de caracteres -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Escala de la página -->
    <title>Administrador</title> <!-- Título de la página -->
    <meta property="og:type" content="website"> <!-- Tipo de contenido -->
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon"> <!-- Ícono de la página -->
    <meta property="og:title" content="Administrador"> <!-- Título del contenido -->
    <meta property="og:site_name" content="Proyecto ADSO"> <!-- Nombre del sitio -->
    <meta name="author" content="Dejatori"> <!-- Autor de la página -->
    <meta name="description" content="Práctica en clases proyecto ADSO"> <!-- Descripción de la página -->
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;display=swap'> <!-- Enlace a Google Fonts -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css"> <!-- Enlace a Bootstrap -->
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css"> <!-- Enlace a Font Awesome -->
    <link rel="stylesheet" href="assets/css/animate.min.css"> <!-- Enlace a Animate -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css'> <!-- Enlace a Normalize -->
    <link rel="stylesheet" href="assets/css/footer.css"> <!-- Enlace a la hoja de estilos -->
</head>

<body>
<?php
// Incluir el encabezado de la página
require_once 'templates/header.php'; // require_once: incluye el archivo solo una vez
?>
<?php
// Incluir el pie de página
require_once 'templates/footer.php';
?>
<!-- Scripts -->
<script src='assets/js/jquery.min.js'></script>
<script src='assets/bootstrap/js/bootstrap.min.js'></script>
<script src='assets/js/chart.min.js'></script>

</body>

</html>