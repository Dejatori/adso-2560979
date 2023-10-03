<?php
// Conexion a la Base Datos
$mysqli=new mysqli('localhost:3306', 'root', '', 'Despachos');

// Valida si se conecto a la Base de Datos
if ($mysqli->connect_error) { // Si hay error termina la aplicación
    printf("Conexión fallida: %s\n", $mysqli->connect_error); // Muestra el error -- printf es un print especial que permite formatear la salida
    exit();
}  

// Recupera el listado de Productos y lo guarda en $ListPro
$Sql="Select Id_Producto, P.Descripcion DescPro, P.Precio_Unitario, UM.Descripcion DescMed From Productos P, 
	UNIDADES_MEDIDA UM	Where UM.Id_Unidad=P.Id_Medida"; // Prepara la consulta
		
$ListPro=$mysqli->query($Sql); // Ejecuta la consulta y guarda el resultado en $ListPro
?>
<a href="Edita.php?Id_Producto=<?php Echo $Row['Id_Producto']?>">Nuevo Producto</a><br> <!-- Envia el Id_Producto a la pagina Editar.php -->
<?php
echo 'Id_Producto' . " | " . 'Producto' . " | " . 'Precio_Unitario' . " | " . 'Medida<br><br>'; // Muestra los datos del Producto
while($Row=$ListPro->fetch_assoc()) { // Recorre el listado de Productos
     echo $Row['Id_Producto'] . " | " . $Row['DescPro'] . " | " . $Row['Precio_Unitario'] . " | " . $Row['DescMed']; // Muestra los datos del Producto
?>
	  <a href="Edita.php?Id_Producto=<?php Echo $Row['Id_Producto']?>">Editar</a> <!-- Envia el Id_Producto a la pagina Editar.php -->
	  <a href="Borra.php?Id_Producto=<?php Echo $Row['Id_Producto']?>">Borrar</a> <!-- Envia el Id_Producto a la pagina Borrar.php -->
	  <br>
	  
	  <?php
} // Cierra el While
?>