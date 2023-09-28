<?php
if(!isset($_GET["Id_Persona"])) exit(); // Si no se recibe el Id_Persona por GET, el script termina usando "exit();"
$Id_Persona = $_GET["Id_Persona"]; // Si se recibe el Id_Persona por GET, se almacena en la variable $Id_Persona
include_once "base_de_datos.php"; // Incluimos el archivo de conexión a la base de datos
$sentencia = $base_de_datos->prepare("DELETE FROM personas WHERE Id_Persona = ?;"); // Preparamos la consulta
// DELETE FROM personas = Eliminar de la tabla personas
// WHERE Id_Persona = ? = Donde el Id_Persona sea igual al Id_Persona recibido por GET
$resultado = $sentencia->execute([$Id_Persona]); // Ejecutamos la consulta
if($resultado === TRUE) {echo "Eliminado correctamente"; // Si la consulta se ejecutó correctamente, mostramos un mensaje de éxito
    header("location:listarPersonas_PDO.php");} // Redireccionamos a la lista de personas
else echo "Algo salió mal"; // Si la consulta no se ejecutó correctamente, mostramos un mensaje de error
?>