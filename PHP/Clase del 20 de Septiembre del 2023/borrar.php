<?php
include("function.php"); // Incluimos la función para borrar.
$Id_Producto = $_GET['Id_Producto']; // Obtenemos el Id_Producto.
delete('Productos', 'Id_Producto', $Id_Producto); // Llamamos a la función delete.
header("location:index.php"); // Redireccionamos al index.
?> <!-- Como este archivo solo tiene código php no es necesario cerrarlo, pero igual lo hacemos. -->