<?php
// Incluir los archivos necesarios 
require_once 'clase_auth.php';

(session_status() === PHP_SESSION_NONE ? session_start() : ''); // Iniciar la sesión si no está iniciada

// Redirigir al usuario si ya hay una sesión iniciada
redirectToHomePageIfLoggedIn();

// Rellenar automáticamente los campos de correo y contraseña si existe la cookie de recordar
$correo = getRememberedEmail();
$clave = getRememberedPassword();
$remembered_checked = isRememberedEmailSet() ? 'checked' : '';

// Función para redirigir al usuario a la página de inicio si ya hay una sesión iniciada
function redirectToHomePageIfLoggedIn(): void
{
    if (isUserLoggedIn()) { // Si el usuario ya tiene una sesión iniciada
        if (isUserType('Usuario') || isUserType('Usuario_verificado') || isUserType('Afiliado_empresa')) { // Si el usuario es un usuario normal o un usuario verificado o un afiliado de empresa
            header('Location: inicio.php'); // Redirigir al usuario a la página de inicio
        } elseif (isUserType('Desarrollador') || isUserType('Administrador CEO')) { // Si el usuario es un desarrollador o un administrador CEO
            header('Location: /admin'); // Redirigir al usuario a la página de administración
        } elseif (isUserType('Soporte correos' || isUserType('Soporte técnico') || isUserType('Soporte de prueba'))) { // Si el usuario es un soporte de correos o un soporte técnico o un soporte de prueba
            header('Location: /soporte'); // Redirigir al usuario a la página de soporte
        } else { // Si el usuario no es ninguno de los anteriores
            $_SESSION['tipo_usuario'] = null; // Establecer el tipo de usuario a null
        }
    }
}

// Función para verificar si el usuario tiene una sesión iniciada
function isUserLoggedIn(): bool
{
    return isset($_SESSION['tipo_usuario']);
}

// Función para verificar el tipo de usuario actual
function isUserType($userType): bool
{
    return $_SESSION['tipo_usuario'] == $userType; // Devolver verdadero si el tipo de usuario actual es igual al tipo de usuario especificado
}

// Función para obtener el correo recordado almacenado en la cookie
function getRememberedEmail()
{
    return $_COOKIE['remembered_email'] ?? ''; // Retornar el valor de correo almacenado en la cookie
}

// Función para obtener la contraseña recordada almacenada en la cookie
function getRememberedPassword()
{
    return $_COOKIE['remembered_password'] ?? ''; // Retornar el valor de contraseña almacenado en la cookie
}

// Función para verificar si se ha establecido la cookie de recordar correo
function isRememberedEmailSet(): bool
{
    return isset($_COOKIE['remembered_email']); // Devolver verdadero si la cookie de recordar correo está establecida
}
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
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <main>
        <div class="container">
            <div class="text-center">
                <h1 class="h4 mb-4">¡Bienvenido!</h1>
            </div>
            <form class="user-form text-center" action="logear.php" method="POST" id="login_user">
                <div class="mb-3">
                    <label class="label" for="correo"></label>
                    <input class="input" id="correo" type="email" aria-describedby="emailHelp" placeholder="Ingresa tu correo" name="correo" autofocus value="<?php echo $correo; ?>" required />
                </div>
                <div class="mb-3">
                    <label class="label" for="clave"></label>
                    <input class="input" id="clave" type="password" placeholder="Contraseña" name="clave" value="<?php echo $clave; ?>" required />
                </div>
                <div class="mb-3">
                    <label class="checkbox-label" for='remember-me'>Recordarme</label>
                    <input class="checkbox-input" id="remember-me" type="checkbox" name="remember-me" <?php echo $remembered_checked; ?> />
                </div>
                <button class="btn d-block w-100" type="submit">
                    Iniciar sesión
                </button>
            </form>
            <div class="text-center">
                <a class="small" href="olvidaste_tu_contrasena.php">¿Olvidaste tu contraseña?</a>
            </div>
            <div class="text-center">
                <a class="small" href="crear_usuario.php">Crear un usuario</a>
            </div>
        </div>
    </main>
</body>

</html>