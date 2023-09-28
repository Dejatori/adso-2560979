<?php 
include("function.php");
$Id_Producto = $_GET['Id_Producto'];
delete('Productos','Id_Producto',$Id_Producto);
header("location:index.php");
?>