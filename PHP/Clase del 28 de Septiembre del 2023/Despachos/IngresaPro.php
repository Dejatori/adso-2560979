<br>
<h2>INGRESAR PRODUCTOS</h2>
<br><br>
<?php 

// Conexion a la Base Datos
include_once 'ConexionDesp.php';
$mysqli = new mysqli($host, $usuario, $clave, $baseDatos);

// Averigua si hya problemas de Conexión
if ($mysqli->connect_errno) {
    printf("Conexión fallida: %s\n", $mysqli->connect_error);
    exit();
}

$Cadena = "select Id_Unidad, Descripcion DescMedida from Unidades_Medida";
$Unidades = $mysqli->query($Cadena);
?>

<table border="1" width="50%">
	<tr>
    <th>Descripción</th>
	<th>Precio Unitario</th>  
	<th>Stock</th>	
    <th>Unidad Medida</th>
	</tr>
<form action="" method="post">
	<tr>
    <input name="Id_Producto" type="hidden" placeholder="Id_Producto">
    <td><input name="Descripcion" type="text" placeholder="Descripción"></td>
	<td><input name="Precio_Unitario" type="text"  placeholder="Precio Unitario"></td>  
	<td><input name="Stock" type="text" placeholder="Stock"></td>	
    <td>
	<select name="Id_Medida" id="Id_Medida">
	<?php while($reg = mysqli_fetch_object($Unidades)){ 
			echo "<option value=".$reg->Id_Unidad.">".$reg->DescMedida."</option>";
		}	
	?>
      </select>			
	</td>
	</tr>	
	<tr>
    <td colspan=2 colspan=2 align ="center"><input type="submit" name="Cancelar" class="btn btn-primary" value="Cancelar"></td>
    <td colspan=2 colspan=2 align ="center"><input type="submit" name="Ingresa" class="btn btn-primary" value="Ingresa"></td>
	</tr>		
</form>
</table>

<?php
	if(isset($_POST['Ingresa'])){
		$Cadena = "INSERT INTO PRODUCTOS (Descripcion, Precio_Unitario, Stock, Id_Medida) ";
		$Cadena = $Cadena . "VALUES ('" . $_POST['Descripcion'] . "'," . $_POST['Precio_Unitario'] . ", " . $_POST['Stock'] . ", " . $_POST['Id_Medida'] . ")";
		echo "$Cadena: ". $Cadena;		
		$Producto = $mysqli->query($Cadena);
		header("location:Productos.php");
	} else {
			if(isset($_POST['Cancelar'])){
				header("location:Productos.php");
			}
	}
?>
