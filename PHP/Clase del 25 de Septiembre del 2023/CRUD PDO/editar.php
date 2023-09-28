<?php
// Si no se ha enviado el formulario, se ejecuta esta parte del código
if(!isset($_GET["Id_Persona"])) exit(); // Si no se recibe el Id_Persona por GET, el script termina usando "exit();"
// Eso significa que no se encontró la persona a editar y por lo tanto no puede continuar el script

$Id_Persona  = $_GET["Id_Persona"]; // Si se recibe el Id_Persona por GET, se almacena en la variable $Id_Persona
include_once "base_de_datos.php"; // Incluimos el archivo de conexión a la base de datos

// Declaramos una consulta SQL para seleccionar a la persona con el Id_Persona recibido por GET
$consulta = "SELECT P.Id_Persona, P.Nombre, P.Apellido, P.Id_TipoDcto, TD.Descripcion Dcto, Nro_Dcto FROM personas P, Tipo_Documento TD Where P.Id_TipoDcto=TD.Id_TipoDcto and P.Id_Persona = ?;";
$sentencia = $base_de_datos->prepare($consulta); // Preparamos la consulta
$sentencia->execute([$Id_Persona]); // Ejecutamos la consulta
$persona = $sentencia->fetch(PDO::FETCH_OBJ); // Obtenemos la primera persona usando la extensión PDO::FETCH_OBJ
if($persona === FALSE){ // Si no existe alguna persona con ese Id_Persona mostramos un mensaje de error y terminamos el script
	#No existe
	echo "¡No existe alguna persona con ese ID!";
	exit();
}

#Si la persona existe, se ejecuta esta parte del código

$TiposDctos = "SELECT Id_TipoDcto, Descripcion FROM Tipo_Documento"; // Consulta para obtener los tipos de documentos
$TipDtos = $base_de_datos->prepare($TiposDctos, [ // Preparamos la consulta
    PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL,
	// PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY, // Necesitamos que el cursor sea de tipo scroll para poder recorrer los resultados
	// Esto se debe a que PDO no permite recorrer los resultados más de una vez usando el cursor por defecto
	// Para más información, visita: https://www.php.net/manual/es/pdostatement.fetch.php
]);
$TipDtos->execute(); // Ejecutamos la consulta

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Registrar persona</title>
</head>
<body>
	<form method="post" action="guardarDatosEditados.php"> <!-- Este formulario envía los datos a guardarDatosEditados.php -->
	<h1>PERSONAS</h1>
<br><br>
<table border="1" width="50%">
	<tr>
    <th>Nombre</th>
	<th>Apellido</th>  
    <th>Tipo Dcto</th>
    <th># Dcto</th>	
	</tr>
	<tr>
	<input type="hidden" name="Id_Persona" value="<?php echo $persona->Id_Persona; ?>"> <!-- Este campo es invisible pero es necesario para guardar el Id_Persona de la persona a editar -->
    <td><input name="Nombre" required type="text" id="Nombre" value="<?php echo $persona->Nombre ?>"></td> <!-- El campo "Nombre" tiene como valor por defecto el nombre de la persona a editar -->
    <td><input name="Apellido" required type="text" id="Apellido" value="<?php echo $persona->Apellido ?>"></td> <!-- El campo "Apellido" tiene como valor por defecto el apellido de la persona a editar -->
    <td>
	<select name="Id_TipoDcto" id="Id_TipoDcto"> <!-- El campo "Id_TipoDcto" tiene como valor por defecto el Id_TipoDcto de la persona a editar -->
	<?php while ($TD = $TipDtos->fetchObject()) { // Recorremos los resultados de la consulta y los mostramos en un elemento select
	if (trim($TD->Id_TipoDcto)==trim($persona->Id_TipoDcto)) { // Si el Id_TipoDcto de la persona a editar es igual al Id_TipoDcto del tipo de documento que se está recorriendo, se selecciona ese tipo de documento
		echo "<option value=".$TD->Id_TipoDcto." SELECTED>".$TD->Descripcion."</option>";
		// La palabra SELECTED hace que el elemento option se seleccione automáticamente
		}	
		else { // Si el Id_TipoDcto de la persona a editar no es igual al Id_TipoDcto del tipo de documento que se está recorriendo, se muestra ese tipo de documento en el elemento select
		echo "<option value=".$TD->Id_TipoDcto." >".$TD->Descripcion."</option>";
		}
	}
	?>
      </select>			
	</td>
	<td><input name="Nro_Dcto" type="text" value="<?php echo $persona->Nro_Dcto ?>"></td> <!-- El campo "Nro_Dcto" tiene como valor por defecto el Nro_Dcto de la persona a editar -->
	</tr>	
	<tr><td></td><td></td><td></td><td>
	<input type="submit" name="submit" value="Guardar cambios"> <!-- Este botón envía los datos a guardarDatosEditados.php -->
	</td></tr>
</form>
</table>
<br><br>
	</form>
</body>
</html>