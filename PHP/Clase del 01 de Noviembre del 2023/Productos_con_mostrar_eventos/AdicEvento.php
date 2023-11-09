<br>
<h2>INGRESAR EVENTO</h2>
<br><br>
<?php 
$Id_Producto = $_GET['Id_Producto'];

// Conexion a la Base Datos
include_once 'Conexion.php';
date_default_timezone_set('America/Bogota');
try {
    $conn = new PDO("mysql:host=$host;dbname=$baseDatos", $usuario, $clave);
} catch (PDOException $pe) {
    die("Nada de Conexión $baseDatos :" . $pe->getMessage());
}

//$Cadena="Select Id_Producto, Descripcion , Precio_Unitario, Stock, Id_Medida
		//From Productos Where Id_Producto=".$Id_Producto;

$Cadena="Select Id_Producto, P.Descripcion DescPro, P.Precio_Unitario, Stock, Id_Medida, UM.Descripcion DescMed 
	From Productos P, UNIDADES_MEDIDA UM Where Id_Producto=".$Id_Producto." and UM.Id_Unidad=P.Id_Medida";		
		
$Prod = $conn -> prepare($Cadena); 
// Ejecutamos la sentencia SQL
$Prod -> execute();

$Producto = $Prod->fetchObject();

$Cadena = "select Id_TipoEvento, Nombre, Descripcion from Tipo_Eventos";
$TipoEventos = $conn -> prepare($Cadena); 
// Ejecutamos la sentencia SQL
$TipoEventos -> execute();

$FechaTmp = new DateTime('Now');
$FechaHOY = $FechaTmp->format('Y-m-d H:i:s');
?>

<table border="1" width="50%">
	<tr>
    <th>Producto</th>
	<th>Precio Unitario</th>  
	<th>Stock</th>	
    <th>Unidad Medida</th>
    <th>Tipo Evento</th>	
    <th>Fecha</th>		
    <th>Descripcion</th>			
	</tr>
<form action="" method="post">
	<tr>
    <input name="Id_Producto" type="hidden" value="<?=$Producto->Id_Producto?>">
    <td><input name="Descripcion" type="text" value="<?=$Producto->DescPro?>"></td>
	<td><input name="Precio Unitario" type="text" value="<?=$Producto->Precio_Unitario?>" placeholder="Precio_Unitario"></td>  
	<td><input name="Stock" type="text" value="<?=$Producto->Stock?>" placeholder="Stock"></td>			
	<td><input name="Unidad Medida" type="text" value="<?=$Producto->DescMed?>" placeholder="DescMed"></td>  	
    <td>
	<select name="Id_TipoEvento" id="Id_TipoEvento">
	<?php while($TipoE = $TipoEventos->fetchObject()){ 
			echo "<option value=".$TipoE->Id_TipoEvento.">".$TipoE->Nombre."</option>";
		}	
	?>
    </select>		
	</td>
	<td><input name="Fecha" value='<?php echo $FechaHOY ?>' type="text" placeholder='<?php echo $FechaHOY ?>'></td>  
	<td><input name="Descripcion" type="text" placeholder="Descripcion"></td>		
	</tr>	
	<tr>
    <td colspan=2 colspan=2 align ="center"><input type="submit" name="Cancelar" class="btn btn-primary" value="Cancelar"></td>
    <td colspan=2 colspan=2 align ="center"><input type="submit" name="Ingresar" class="btn btn-primary" value="Ingresar"></td>
	</tr>		
</form>
</table>

<?php
	if(isset($_POST['Ingresar'])){
		$Fecha=$_POST['Fecha'];
		$Cadena = "INSERT INTO EVENTOS (Id_TipoEvento, Id_Producto, Fecha, Descripcion) ";
		$Cadena = $Cadena . "VALUES (" . $_POST['Id_TipoEvento'] . "," . $_POST['Id_Producto'] . ", '" . $Fecha . "', '" . $_POST['Descripcion'] . "')";
		echo "Cadena: ". $Cadena;		
		$Producto = $conn -> prepare($Cadena); 
		$Producto -> execute(); 
		header("location:EventosPro.php");
	} else {
			if(isset($_POST['Cancelar'])){
				header("location:EventosPro.php");
			}
	}
?>