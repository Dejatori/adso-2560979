<?php
#Salir si alguno de los datos no está presente
if(!isset($_POST["Id_Persona"]) || !isset($_POST["Nombre"]) || !isset($_POST["Apellido"]) || !isset($_POST["Id_TipoDcto"])  || !isset($_POST["Nro_Dcto"]) ) exit();

#Si todo va bien, se ejecuta esta parte del código...

include_once "base_de_datos.php";

$Nombre = $_POST["Nombre"];
$Apellido = $_POST["Apellido"];
$Id_TipoDcto = $_POST["Id_TipoDcto"];
$Nro_Dcto = $_POST["Nro_Dcto"];

$consulta = "SELECT Id_Persona, Nombre, Apellido, Id_TipoDcto, Nro_Dcto FROM personas Where Nro_Dcto = ?;";
$sentencia = $base_de_datos->prepare($consulta);
$sentencia->execute([$Nro_Dcto]);
$persona = $sentencia->fetch(PDO::FETCH_OBJ);
if($persona === FALSE){
	#No existe
	/*
	Al incluir el archivo "base_de_datos.php", todas sus variables están
	a nuestra disposición. Por lo que podemos acceder a ellas tal como si hubiéramos
	copiado y pegado el código
	*/

	$sentencia = $base_de_datos->prepare("INSERT INTO personas(Nombre, Apellido, Id_TipoDcto, Nro_Dcto) VALUES (?, ?, ?, ?);");
	$resultado = $sentencia->execute([$Nombre, $Apellido, $Id_TipoDcto, $Nro_Dcto]); # Pasar en el mismo orden de los ?

	#execute regresa un booleano. True en caso de que todo vaya bien, falso en caso contrario.
	#Con eso podemos evaluar

	if($resultado === TRUE) {echo "Insertado correctamente";header("location:listarPersonas_PDO.php");}
		else {echo "Algo salió mal. Por favor verifica que la tabla exista";header("location:listarPersonas_PDO.php");}
	}

else 
{
	echo "¡Ya existe una persona con ese Número de Documento!";
	header("location:listarPersonas_PDO.php");
	exit();
}
?>