<?php
/*
	CRUD con MySQL y PHP
	SENA
	2023
*/

// Incluimos nuestra conexión
$contraseña = ""; // En este caso no tiene contraseña la base de datos
$usuario = "root"; // Usuario de la base de datos
$nombre_base_de_datos = "Despachos"; // Nombre de la base de datos

try { // Intentamos conectarnos a la base de datos
    // Creamos una variable $base_de_datos para almacenar la conexión a la base de datos usando PDO
    $base_de_datos = new PDO('mysql:host=localhost;dbname=' . $nombre_base_de_datos, $usuario, $contraseña);
} catch (Exception $e) { // Si no se puede conectar a la base de datos
    echo "Ocurrió algo con la base de datos: " . $e->getMessage(); // Mostramos el error
}
?>