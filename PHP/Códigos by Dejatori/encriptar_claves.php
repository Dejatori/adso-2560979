<?php
require_once 'clase_conexion.php';

$success = true; // Variable de bandera

// Crear objeto de conexión
$pdo = new Conexion();
$conexion = $pdo->conectar();

// Obtener los registros de los nuevos usuarios con contraseñas sin encriptar
$sql = $conexion->prepare("SELECT ID_Usuario, Clave FROM usuarios WHERE Clave NOT LIKE '$2y$%'"); // Seleccionar los usuarios que no tienen la contraseña encriptada
$sql->execute(); // Ejecutar la consulta
$usuarios = $sql->fetchAll(PDO::FETCH_ASSOC); // Obtener los registros de la consulta

// Recorrer los registros y encriptar las contraseñas utilizando password_hash
foreach ($usuarios as $usuario) {
    $id_usuario = $usuario['ID_Usuario']; // Obtener el ID del usuario
    $clave = $usuario['Clave']; // Obtener la contraseña sin encriptar
    $clave_encriptada = password_hash($clave, PASSWORD_DEFAULT); // Encriptar la contraseña

    // Actualizar la contraseña en la base de datos
    $sql = $conexion->prepare('UPDATE usuarios SET Clave = :clave_encriptada WHERE ID_Usuario = :id_usuario'); // Preparar la consulta
    $sql->bindParam(':clave_encriptada', $clave_encriptada); // Asignar el valor de la contraseña encriptada
    $sql->bindParam(':id_usuario', $id_usuario); // Asignar el valor del ID del usuario

    // Verificar si la actualización se realizó correctamente
    if (!$sql->execute()) {
        $success = false; // Actualización fallida
        break; // Salir del bucle si hay un error
    }
}

// Mostrar mensaje de éxito o error
if ($success) {
    echo 'Todas las contraseñas se han encriptado correctamente.';
} else {
    echo 'Ha ocurrido un error al encriptar las contraseñas.';
}