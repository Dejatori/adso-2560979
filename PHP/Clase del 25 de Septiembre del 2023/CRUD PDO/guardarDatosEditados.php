<?php

#Salir si alguno de los datos no está presente
if(
	!isset($_POST["Id_Persona"]) || 
	!isset($_POST["Nombre"]) || 
	!isset($_POST["Apellido"]) || 
	!isset($_POST["Id_TipoDcto"]) ||
	!isset($_POST["Nro_Dcto"])
	// Si no se recibe el Id_Persona, el Nombre, el Apellido, el Id_TipoDcto o el Nro_Dcto por POST, el script termina usando "exit();"
) exit();

#Si todo va bien, se ejecuta esta parte del código...

include_once "base_de_datos.php"; // Incluimos el archivo de conexión a la base de datos

// Obtener los valores que el usuario escribió en el formulario
$Id_Persona = $_POST["Id_Persona"];
$Nombre = $_POST["Nombre"];
$Apellido = $_POST["Apellido"];
$Id_TipoDcto = $_POST["Id_TipoDcto"];
$Nro_Dcto = $_POST["Nro_Dcto"];

// Consulta para obtener a la persona con el Nro_Dcto recibido por POST
$consulta = "SELECT Id_Persona, Nombre, Apellido, Id_TipoDcto, Nro_Dcto FROM personas Where Nro_Dcto = ?;"; 
$sentencia = $base_de_datos->prepare($consulta); // Preparamos la consulta
$sentencia->execute([$Nro_Dcto]); // Ejecutamos la consulta
$persona = $sentencia->fetch(PDO::FETCH_OBJ); // Obtenemos la primera persona usando la extensión PDO::FETCH_OBJ

if($persona === FALSE){ // Si no existe alguna persona con ese Nro_Dcto, se ejecuta esta parte del código
	// Preparamos la consulta para actualizar los datos de la persona con el Id_Persona recibido por POST
	$sentencia = $base_de_datos->prepare("UPDATE personas SET Nombre = ?, Apellido = ?, Id_TipoDcto = ?, Nro_Dcto = ? WHERE Id_Persona = ?;");
	$resultado = $sentencia->execute([$Nombre, $Apellido, $Id_TipoDcto, $Nro_Dcto, $Id_Persona]); # Pasar en el mismo orden de los ?
	if($resultado === TRUE) { // Si la consulta se ejecutó correctamente, mostramos un mensaje de éxito
		echo "Cambios guardados";
		header("location:listarPersonas_PDO.php"); // Redireccionamos a la lista de personas
	}
	else { // Si la consulta no se ejecutó correctamente, mostramos un mensaje de error
		echo "Algo salió mal. Por favor verifica que la tabla exista";
		header("location:listarPersonas_PDO.php");} // Redireccionamos a la lista de personas
	}
else // Si existe alguna persona con ese Nro_Dcto, se ejecuta esta parte del código
{
	echo "¡Ya existe una persona con ese Número de Documento!"; // Mostramos un mensaje de error
	header("location:listarPersonas_PDO.php"); // Redireccionamos a la lista de personas
}
?>