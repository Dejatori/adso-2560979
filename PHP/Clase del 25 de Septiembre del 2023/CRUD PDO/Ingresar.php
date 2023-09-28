<?php
include_once "base_de_datos.php";

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
	<form method="post" action="nuevaPersona.php">
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
	<input type="hidden" name="Id_Persona" placeholder="Id_Persona">
    <td><input name="Nombre" required type="text" id="Nombre" placeholder="Nombre"></td>
    <td><input name="Apellido" required type="text" id="Apellido" placeholder="Apellido"></td>	
    <td>
	<select name="Id_TipoDcto" id="Id_TipoDcto">
	<?php while ($TD = $TipDtos->fetchObject()) {		
		echo "<option value=".$TD->Id_TipoDcto." >".$TD->Descripcion."</option>";
		}
	?>
      </select>			
	</td>
	<td><input name="Nro_Dcto" type="text" placeholder="Nro_Dcto"></td>  
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