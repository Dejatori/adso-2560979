<?php
// Conexion a la Base Datos
$mysqli=new mysqli('localhost:3306', 'root', '', 'Despachos');

// Valida si se conecto a la Base de Datos
if ($mysqli->connect_error) { // Si hay error termina la aplicación
    printf("Conexión fallida: %s\n", $mysqli->connect_error); // Muestra el error -- printf es un print especial que permite formatear la salida
    exit();
}  

// Recupera el listado de Unidades de Medida en $Result
$Result=$mysqli->query("SELECT * FROM UNIDADES_MEDIDA"); // Ejecuta la consulta y guarda el resultado en $Result

// Recupera el listado de Productos y lo guarda en $ListPro
$Sql="Select * From Productos"; // Prepara la consulta
$ListPro=$mysqli->query($Sql); // Ejecuta la consulta y guarda el resultado en $ListPro

// Muestra el listado de Productos
while($Row=$ListPro->fetch_assoc()) { // Recorre el listado de Productos
     echo $Row['Id_Producto'] . " | " . $Row['Descripcion'] . " | " . $Row['Precio_Unitario']; // Muestra los datos del Producto
?>
<!-- Muestra el listado de Unidades de Medida -->
<select name="Id_Medida" id="Id_Medida">
	<?php foreach ($Result as $Uni) { // Recorre el listado de Unidades de Medida
	if (Trim($Uni['Id_Unidad'])==trim($Row['Id_Medida'])) // Valida si la Unidad de Medida es la misma del Producto
		echo "<option value=".$Uni['Id_Unidad']." Selected>".$Uni['Descripcion']."</option>"; // Si es la misma la selecciona
	else
		echo "<option value=".$Uni['Id_Unidad'].">".$Uni['Descripcion']."</option>"; // Si no es la misma la muestra en el listado
	} ?>
      </select>
	  <a href="Editar.php?Id_Producto=<?php Echo $Row['Id_Producto']?>">Editar</a> <!-- Envia el Id_Producto a la pagina Editar.php -->
	  <a href="Borrar.php?Id_Producto=<?php Echo $Row['Id_Producto']?>">Borrar</a> <!-- Envia el Id_Producto a la pagina Borrar.php -->
	  <br>
	  
	  <?php // Cierra el While
}
?>