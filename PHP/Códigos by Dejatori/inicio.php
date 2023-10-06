<?php
global $pageTitle;
session_start();
?>

<!DOCTYPE html>
<html lang="es-419">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login de práctica</title>
    <meta property="og:type" content="website">
    <link rel="icon" href="assets/img/favicon/favicon.ico" type="image/x-icon">
    <meta name="description" content="Página de practica en el Sena.">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<?php require_once 'templates/header.php'; ?>
<main>
    <div class="container text-center">
        <h1 class="mb-4">¡HEMOS COMPLETADO EL LOGIN!</h1>
        <p class="mb-4">¡Bienvenido, <?php echo $_SESSION['nombre'] . ' ' . $_SESSION['apellido']; ?>!</p>
        <p class="mb-4">¡Tu correo es: <?php echo $_SESSION['correo']; ?></p>
        <p class="mb-4">¡Tu contraseña es: <?php echo $_SESSION['clave']; ?></p>
        <p class="mb-4">¡Tu tipo de usuario es: <?php echo $_SESSION['tipo_usuario']; ?></p>
        <p class="mb-4">¡Tu tipo de documento de identidad es: <?php echo $_SESSION['tipo_doc_identidad']; ?></p>
        <p class="mb-4">¡Tu documento de identidad es: <?php echo $_SESSION['doc_identidad']; ?></p>
        <p class="mb-4">¡Tu fecha de nacimiento es: <?php echo $_SESSION['fecha_nacimiento']; ?></p>
    </div>
<?php require_once 'templates/footer.php'; ?>
</main>
</body>
</html>