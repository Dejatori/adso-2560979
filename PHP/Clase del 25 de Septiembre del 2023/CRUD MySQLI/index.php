<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title> PRODUCTOS </title>
</head>

<body>

<?php
	include("function.php"); //Incluimos nuestra librería de funciones (archivo function.php)
	if(isset($_POST['submit'])){ // Comprobamos si se ha enviado el formulario
		$field = array("Id_Producto"=>$_POST['Id_Producto']); // Declaramos un array para almacenar los datos del formulario
		$tbl = "Productos"; // Tabla donde se insertarán los datos
		insert($tbl,$field); // Insertamos los datos
	}
?>

<?php 
	// Consulta para traer los datos de la tabla Unidades_Medida (UM)
	$sql = "select Id_Unidad, UM.Descripcion DescMedida from Unidades_Medida UM"; 
	$result = db_query($sql); // Ejecutamos nuestra consulta
?>

<h1>PRODUCTOS</h1>
<br><br>
<!-- Tabla donde se mostrarán los datos de la tabla Productos -->
<table border="1" width="50%">
	<tr>
    <th>Descripción</th>
	<th>Precio Unitario</th>  
	<th>Stock</th>	
    <th>Unidad Medida</th>
	</tr>
<!-- Formulario para insertar los datos de la tabla Productos -->
<form action="" method="post">
	<tr>
    <input name="Id_Producto" type="hidden" placeholder="Id_Producto"> <!-- Creamos un campo oculto para enviar el Id_Producto -->
    <td><input name="Descripcion" type="text" placeholder="Descripcion"></td> <!-- Creamos un campo para ingresar la Descripcion -->
	<td><input name="Precio_Unitario" type="text" placeholder="Precio_Unitario"></td> <!-- Creamos un campo para ingresar el Precio_Unitario -->
	<td><input name="Stock" type="text" placeholder="Stock"></td> <!-- Creamos un campo para ingresar el Stock -->
    <td>
	<select name="Id_Medida" id="Id_Medida"> <!-- Creamos un campo para seleccionar la Unidad Medida -->
	<?php while($row = mysqli_fetch_object($result)){  // Recorremos el resultado de nuestra consulta para mostrar los datos de la tabla Unidades_Medida
		echo "<option value=".$row->Id_Unidad.">".$row->DescMedida."</option>"; // Mostramos el campo sin seleccionar si el valor del campo Id_Medida de la tabla Productos es diferente al valor del campo Id_Unidad de la tabla Unidades_Medida
	} ?>
      </select>			
	</td>
    <td><input type="submit" name="submit" value="Insertar"></td> <!-- Creamos el botón para enviar los datos del formulario -->
	</tr>	

</form>
</table>
<br><br>

<!-- Tabla donde se mostrarán los datos de la tabla Productos -->
<table border="1" width="100%">
	<tr>
    <th>Id Producto</th>
    <th>Descripción</th>
	<th>Precio Unitario</th>  
	<th>Stock</th>	
    <th>Id Medida</th>
    <th>Unidad Medida</th>
    <th>ACCION</th>	
	</tr>
<?php
	// Consulta para traer los datos de la tabla Productos y Unidades_Medida
	// (P.Descripcion DescProducto) es un alias para el campo Descripcion de la tabla Productos (P)
	// (UM.Descripcion DescMedida) es un alias para el campo Descripcion de la tabla Unidades_Medida (UM)
	$sql = "select Id_Producto, P.Descripcion DescProducto, Precio_Unitario, Stock, Id_Medida, UM.Descripcion DescMedida from Productos P, Unidades_Medida UM where P.Id_Medida=UM.Id_Unidad";
	$result = db_query($sql); // Ejecutamos nuestra consulta
	
	while($row = mysqli_fetch_object($result)){ // Recorremos el resultado de nuestra consulta para mostrar los datos de la tabla Productos y Unidades_Medida
	?>
	<tr>
		<td><?php echo $row->Id_Producto;?></td>
		<td><?php echo $row->DescProducto;?></td>
		<td><?php echo $row->Precio_Unitario;?></td>
		<td><?php echo $row->Stock;?></td>		
		<td><?php echo $row->Id_Medida;?></td>
		<td><?php echo $row->DescMedida;?></td>
		<td>

<a class="btn btn-primary" href="editar.php?Id_Producto=<?php echo $row->Id_Producto; ?>">Editar</a> <!-- Creamos un enlace para editar el registro -->
<a class="btn btn-primary" href="borrar.php?Id_Producto=<?php echo $row->Id_Producto;?>">Borrar</a> <!-- Creamos un enlace para borrar el registro -->
</td>
	</tr>
	<?php } // Cierre del ciclo while ?>
</table>
</div>
</body>
</html>