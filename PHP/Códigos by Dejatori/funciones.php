<?php

function recuerdame($correo, $contrasena): void // void significa que no devuelve nada
{
    // Si el botón "Recordarme" está marcado, crear una cookie
    if (isset($_POST['remember-me']) === true) {
        $expire = time() + (30 * 24 * 60 * 60); // Expira en 30 días
        // Crear una cookie para el correo y otra para la contraseña
        setcookie('remembered_email', $correo, $expire, '/', $_SERVER['HTTP_HOST'], true, false); // midominio.com es el dominio de la cookie
        setcookie('remembered_password', $contrasena, $expire, '/', $_SERVER['HTTP_HOST'], true, false);
    } else {
        // Si no está marcado, eliminar la cookie
        setcookie('remembered_email', '', time() - 3600, '/', $_SERVER['HTTP_HOST'], true, false);
        setcookie('remembered_password', '', time() - 3600, '/', $_SERVER['HTTP_HOST'], true, false);
    }
}

function validarTexto($texto): string
{
    // Eliminar etiquetas HTML y PHP del texto
    $texto = strip_tags($texto);
    // Reemplazar caracteres especiales
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

function validarNumero($numero): int|float|false
{
    // Validar si es un número entero
    $entero = filter_var($numero, FILTER_VALIDATE_INT);
    if ($entero !== false) {
        return $entero; // Es un número entero válido, lo devolvemos como int
    }

    // Validar si es un número flotante
    $flotante = filter_var($numero, FILTER_VALIDATE_FLOAT);
    if ($flotante !== false) {
        return $flotante; // Es un número flotante válido, lo devolvemos como float
    }

    // No es ni un número entero ni flotante válido, devolvemos false
    return false;
}

function validarFecha($fecha): string|bool
{
    // Validar el formato de fecha (date o datetime)
    $fecha_validada = DateTime::createFromFormat('Y-m-d H:i:s', $fecha);
    if (!$fecha_validada) {
        $fecha_validada = DateTime::createFromFormat('Y-m-d', $fecha);
    }

    if (!$fecha_validada) {
        return false;
    }

    // Retornar la fecha en el formato adecuado
    return $fecha_validada->format($fecha_validada->format('H:i:s') === '00:00:00' ? 'Y-m-d' : 'Y-m-d H:i:s');
}

function validarCorreo($correo): string|false
{
    // Eliminar espacios en blanco al inicio y final del correo
    $correo = trim($correo);

    // Validar el correo
    $correo_validado = filter_var($correo, FILTER_VALIDATE_EMAIL);

    // Retornar el correo original si es válido, o false si no lo es
    return $correo_validado ?: false;
}

function validarEntradaEI($entrada): string
{
    // Eliminar espacios en blanco al inicio y final de la entrada
    $entrada = trim($entrada);
    // Eliminar diagonales invertidas (backslashes) de la entrada
    $entrada = stripslashes($entrada);
    // Convertir caracteres especiales en entidades HTML
    return htmlspecialchars($entrada);
}

function evitarInyeccion($conexion, $entrada, $tipoDato): bool|int|string|null
{
    // Validar entrada
    $entrada = validarEntradaEI($entrada);
    // Enlazar parámetros para evitar inyección de código
    switch ($tipoDato) {
        case PDO::PARAM_INT:
            $entrada = (int)$entrada;
            break;
        case PDO::PARAM_BOOL:
            $entrada = (bool)$entrada;
            break;
        case PDO::PARAM_NULL:
            $entrada = null;
            break;
        case PDO::PARAM_STR:
        default:
            // no es necesario hacer nada, ya que la entrada es de tipo string
            break;
    }
    // Enlazar parametro
    $stmt = $conexion->prepare('SELECT 1');
    $stmt->bindParam(':param', $entrada, $tipoDato);
    return $entrada;
}

/**
 * Valida una entrada según un tipo de dato específico y realiza el enlace de parámetros si es necesario.
 *
 * @param PDO $pdo Objeto de conexión PDO configurada.
 * @param mixed $entrada Valor a validar.
 * @param string $tipoDato Tipo de dato permitido ('bool', 'int', 'string', 'null', 'float', 'email', 'date').
 *
 * @return bool|int|float|string|null Devuelve el valor validado si es válido, de lo contrario, devuelve el tipo de dato esperado.
 */
function validarEntrada(PDO $pdo, $entrada, string $tipoDato)
{
    // Verificar si la entrada es nula
    if ($entrada === null) {
        return null;
    }

    // Eliminar espacios en blanco al inicio y final de la entrada
    $entrada = trim($entrada);

    // Eliminar diagonales invertidas (backslashes) de la entrada
    $entrada = stripslashes($entrada);

    // Convertir caracteres especiales en entidades HTML
    $entrada = htmlspecialchars($entrada, ENT_QUOTES, 'UTF-8');

    // Validamos si el tipo de dato es soportado ('bool', 'int', 'string', 'null', 'float', 'email', 'date').
    if (!in_array($tipoDato, ['bool', 'int', 'string', 'null', 'float', 'email', 'date'])) {
        throw new InvalidArgumentException('Tipo de dato no válido. Los tipos válidos son: "bool", "int", "string", "null", "float", "email" o "date".');
    }

    // Comprobamos el tipo de dato de la entrada.
    $tipoEntrada = gettype($entrada);

    // Si la entrada es del tipo esperado, devolvemos el valor validado.
    if ($tipoEntrada === $tipoDato) {
        return $entrada;
    }

    // Si el tipo de dato es 'null', permitimos cualquier valor nulo.
    if ($tipoDato === 'null' && $tipoEntrada === 'NULL') {
        return null;
    }

    // Validamos el tipo de dato específico.
    switch ($tipoDato) {
        case 'bool':
            // Validar si es un valor booleano
            return filter_var($entrada, FILTER_VALIDATE_BOOLEAN);
        case 'int':
            // Validar si es un número entero
            return validarNumero($entrada);
        case 'string':
            // Validar el texto
            return validarTexto($entrada);
        case 'null':
            // En caso de que la entrada no sea nula, se convierte a un valor de cadena vacía
            return '';
        case 'float':
            // Validar si es un número flotante
            return $entrada = validarNumero($entrada);
        case 'email':
            // Validar el correo
            return validarCorreo($entrada);
        case 'date':
            // Validar la fecha
            return validarFecha($entrada);
        default:
            // En caso de que el tipo de dato no se reconozca, devolvemos null
            return null;
    }
}

function encriptarContrasena($contrasena): string
{
    // Encriptar la contraseña
    return password_hash($contrasena, PASSWORD_DEFAULT);
}

function downloadAndSaveFile($url, $destination): void
{
    $fileContent = file_get_contents($url); // Obtener el contenido del archivo
    if ($fileContent !== false) { // Si se obtuvo el contenido del archivo
        file_put_contents($destination, $fileContent); // Guardar el contenido del archivo en la ruta especificada
    }
}

?>