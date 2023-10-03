<?php
include("function.php"); //Incluimos nuestra librería de funciones (archivo function.php)
$Id_Producto = $_GET['Id_Producto']; //Recibimos el Id_Producto a eliminar por medio del método GET
delete('Productos', 'Id_Producto', $Id_Producto); //Mandamos a llamar nuestra función delete, le pasamos los parámetros de la tabla, el campo y el valor a eliminar
header("location:index.php"); //Redireccionamos a nuestro archivo index.php
?>