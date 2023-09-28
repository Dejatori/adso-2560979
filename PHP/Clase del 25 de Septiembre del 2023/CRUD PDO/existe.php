<?php
include_once "base_de_datos.php"; // Incluimos el archivo de conexión a la base de datos
# Recuerda que nombre puede venir de cualquier lugar
$nombre = "Parzibyte";
# Seleccionar el id para que sea ligero, pues no necesitamos obtener los datos, solamente
# queremos saber si existe
$sentencia = $base_de_datos->prepare("SELECT id FROM personas WHERE nombre = ? LIMIT 1;"); // Preparamos la consulta
// SELECT id FROM personas = Seleccionar el id de la tabla personas
// WHERE nombre = ? = Donde el nombre sea igual al nombre recibido por GET
// LIMIT 1 = Limitar la consulta a 1 resultado
$sentencia->execute([$nombre]); // Ejecutamos la consulta
# Ver cuántas filas devuelve
$numeroDeFilas = $sentencia->rowCount(); // Obtenemos el número de filas usando la extensión rowCount
// rowCount = Cuenta el número de filas devueltas por la consulta
# Si son 0 o menos, significa que no existe
if ($numeroDeFilas <= 0) {
    echo "El usuario con nombre $nombre NO existe"; // Si el número de filas es menor o igual a 0, mostramos un mensaje de error
} else {
    echo "El usuario con nombre $nombre SÍ existe"; // Si el número de filas es mayor a 0, mostramos un mensaje de éxito
}
