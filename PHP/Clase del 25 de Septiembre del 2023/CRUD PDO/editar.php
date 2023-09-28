<?php
if(!isset($_GET["Id_Persona"])) exit();
$Id_Persona  = $_GET["Id_Persona"];
include_once "base_de_datos.php";
$consulta = "SELECT P.Id_Persona, P.Nombre, P.Apellido, P.Id_TipoDcto, TD.Descripcion Dcto, Nro_Dcto FROM personas P, Tipo_Documento TD Where P.Id_TipoDcto=TD.Id_TipoDcto and P.Id_Persona = ?;";
$sentencia = $base_de_datos->prepare($consulta);
$sentencia->execute([$Id_Persona]);
$persona = $sentencia->fetch(PDO::FETCH_OBJ);
if($persona === FALSE){
	#No existe
	echo "¡No existe alguna persona con ese ID!";
	exit();
}

#Si la persona existe, se ejecuta esta parte del código

$TiposDctos = "SELECT Id_TipoDcto, Descripcion FROM Tipo_Documento";
$TipDtos = $base_de_datos->prepare($TiposDctos, [
    PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL,
]);
$TipDtos->execute();

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Registrar persona</title>
</head>
<body>
	<form method="post" action="guardarDatosEditados.php">
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
	<input type="hidden" name="Id_Persona" value="<?php echo $persona->Id_Persona; ?>">
    <td><input name="Nombre" required type="text" id="Nombre" value="<?php echo $persona->Nombre ?>"></td>
    <td><input name="Apellido" required type="text" id="Apellido" value="<?php echo $persona->Apellido ?>"></td>	
    <td>
	<select name="Id_TipoDcto" id="Id_TipoDcto">
	<?php while ($TD = $TipDtos->fetchObject()) {		
	if (trim($TD->Id_TipoDcto)==trim($persona->Id_TipoDcto)) {
		echo "<option value=".$TD->Id_TipoDcto." SELECTED>".$TD->Descripcion."</option>";
		}	
		else {
		echo "<option value=".$TD->Id_TipoDcto." >".$TD->Descripcion."</option>";
		}
	}
	?>
      </select>			
	</td>
	<td><input name="Nro_Dcto" type="text" value="<?php echo $persona->Nro_Dcto ?>"></td>  
	</tr>	
	<tr><td></td><td></td><td></td><td>
	<input type="submit" name="submit" value="Guardar cambios">
	</td></tr>
</form>
</table>
<br><br>
	</form>
</body>
</html>