<?php
if(!isset($_GET["Id_Persona"])) exit();
$Id_Persona = $_GET["Id_Persona"];
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("DELETE FROM personas WHERE Id_Persona = ?;");
$resultado = $sentencia->execute([$Id_Persona]);
if($resultado === TRUE) {echo "Eliminado correctamente";
    header("location:listarPersonas_PDO.php");}
else echo "Algo salió mal";
?>