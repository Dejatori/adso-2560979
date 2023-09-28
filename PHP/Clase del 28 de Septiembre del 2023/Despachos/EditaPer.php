<br>
<h2>EDITAR PERSONAS</h2>
<br><br>
<?php 
$Id_Persona = $_GET['Id_Persona'];

// Conexion a la Base Datos
include_once 'ConexionDesp.php';

try {
    $conn = new PDO("mysql:host=$host;dbname=$baseDatos", $usuario, $clave);
} catch (PDOException $pe) {
    die("Nada de Conexión $baseDatos :" . $pe->getMessage());
}

$sql = "select Id_TipoDcto, Descripcion from Tipo_Documento";
$query = $conn -> prepare($sql); 
// Ejecutamos la sentencia SQL
$query -> execute(); 
$LisTipos = $query -> fetchAll(PDO::FETCH_OBJ); 

// Componemos la sentencia SQL
$sql = "select * from Personas where Id_Persona=".$Id_Persona;
$query = $conn -> prepare($sql); 
// Ejecutamos la sentencia SQL
$query -> execute(); 
$LisPer = $query -> fetch(PDO::FETCH_OBJ); 
$Per = $LisPer;
//Verificar existencia de resultados
if($query -> rowCount() > 0)   { 
?>

<table border="1" width="50%">
	<tr>
    <th>Nombre</th>
	<th>Apellido</th>  
	<th>Tipo Dcto</th>	
    <th>Nro Dcto</th>
	</tr>
<form action="" method="post">
	<tr>
    <input name="Id_Persona" type="hidden" value="<?=$LisPer->Id_Persona?>">
    <td><input name="Nombre" type="text" value="<?=$Per->Nombre?>"</td>
	<td><input name="Apellido" type="text" value="<?=$Per->Apellido?>"></td>  
    <td>
	<select name="Id_TipoDcto" id="Id_TipoDcto">
	<?php
	 foreach($LisTipos as $Td) {
 		if (trim($Td->Id_TipoDcto)==trim($Per->Id_TipoDcto)) {
			echo "<option value='".$Td->Id_TipoDcto."' SELECTED>".$Td->Descripcion."</option>";
		}	
		else {
			echo "<option value='".$Td->Id_TipoDcto."' >".$Td->Descripcion."</option>";
		}

	} ?>
      </select>			
	</td>
		<td><input name="Nro_Dcto" type="text" value="<?=$Per -> Nro_Dcto?>" ></td>	
	</tr>	
	<tr>
    <td colspan=2 colspan=2 align ="center"><input type="submit" name="Cancelar" class="btn btn-primary" value="Cancelar"></td>
    <td colspan=2 colspan=2 align ="center"><input type="submit" name="Actualiza" class="btn btn-primary" value="Actualiza"></td>
	</tr>		
</form>
</table>

<?php
	if(isset($_POST['Actualiza'])){
		$Cadena = "UPDATE Personas SET Nombre='" . trim($_POST['Nombre']) . "', Apellido='"
			. trim($_POST['Apellido']) . "', Id_TipoDcto=" . trim($_POST['Id_TipoDcto']) . ", Nro_Dcto='" . trim($_POST['Nro_Dcto'])
			. "' Where Id_Persona=" . trim($_POST['Id_Persona']);
		echo "$Cadena: ". $Cadena;	
		$query = $conn -> prepare($Cadena); 
		// Ejecutamos la sentencia SQL
		$query -> execute(); 		
		header("location:Personas.php");
	} else {
			if(isset($_POST['Cancelar'])){
				header("location:Personas.php");
			}
		}
}		
?>