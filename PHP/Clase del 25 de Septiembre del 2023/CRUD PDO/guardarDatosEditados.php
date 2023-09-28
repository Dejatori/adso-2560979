<?php

#Salir si alguno de los datos no está presente
if(
	!isset($_POST["Id_Persona"]) || 
	!isset($_POST["Nombre"]) || 
	!isset($_POST["Apellido"]) || 
	!isset($_POST["Id_TipoDcto"]) ||
	!isset($_POST["Nro_Dcto"])
) exit();

#Si todo va bien, se ejecuta esta parte del código...

include_once "base_de_datos.php";
$Id_Persona = $_POST["Id_Persona"];
$Nombre = $_POST["Nombre"];
$Apellido = $_POST["Apellido"];
$Id_TipoDcto = $_POST["Id_TipoDcto"];
$Nro_Dcto = $_POST["Nro_Dcto"];

$consulta = "SELECT Id_Persona, Nombre, Apellido, Id_TipoDcto, Nro_Dcto FROM personas Where Nro_Dcto = ?;";
$sentencia = $base_de_datos->prepare($consulta);
$sentencia->execute([$Nro_Dcto]);
$persona = $sentencia->fetch(PDO::FETCH_OBJ);

if($persona === FALSE){
	$sentencia = $base_de_datos->prepare("UPDATE personas SET Nombre = ?, Apellido = ?, Id_TipoDcto = ?, Nro_Dcto = ? WHERE Id_Persona = ?;");
	$resultado = $sentencia->execute([$Nombre, $Apellido, $Id_TipoDcto, $Nro_Dcto, $Id_Persona]); # Pasar en el mismo orden de los ?
	if($resultado === TRUE) {
		echo "Cambios guardados";
		header("location:listarPersonas_PDO.php");
	}
	else {
		echo "Algo salió mal. Por favor verifica que la tabla exista";
		header("location:listarPersonas_PDO.php");}
	}
else 
{
	echo "¡Ya existe una persona con ese Número de Documento!";
	header("location:listarPersonas_PDO.php");
}
?>